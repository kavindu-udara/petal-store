<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Seller;
use App\Http\Middleware\User;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('seller')->group(function () {
    Route::get('/login', [SellerController::class, 'goToLogin'])->name('seller.login.form');
    Route::post('/login/seller', [SellerController::class, 'login'])->name('seller.login');
    Route::get('/register', [SellerController::class, 'goToRegister'])->name('seller.register.form');
    Route::post('/register/seller', [SellerController::class, 'register'])->name('seller.register');
    Route::get('/profile', [SellerController::class, 'goToProfile'])->name('seller.profile')->middleware(Seller::class);
    Route::get('/logout', [SellerController::class, 'logout'])->name('seller.logout');

    Route::post('/register/seller', [SellerController::class, 'register'])->name('seller.register');

    // products route
    Route::get('/new', [SellerController::class, 'goToNewProduct'])->name('seller.new.form')->middleware(Seller::class);

    Route::post('/product/new', [SellerController::class, 'newProduct'])->name('seller.new.product');

    Route::post('/profile/update', [SellerController::class, 'updateProfile'])->name('seller.profile.update');

    // dashboard
    Route::get('/dashboard', [SellerController::class, 'goToDashboard'])->name('seller.dashboard')->middleware(Seller::class);

    Route::prefix('products')->group(function () {
        Route::get('/', [SellerController::class, 'goToProduct'])->name('seller.products.all.list')->middleware(Seller::class);
        Route::get('/pending', [SellerController::class, 'goToPendingProduct'])->name('seller.products.pending.list')->middleware(Seller::class);
        Route::get('/hidden', [SellerController::class, 'goToHiddenProduct'])->name('seller.products.hidden.list')->middleware(Seller::class);
        Route::get('/disapproved', [SellerController::class, 'goToDisapprovedProduct'])->name('seller.products.disaprove.list')->middleware(Seller::class);
        // edit product
        Route::get('/edit/{id}', [SellerController::class, 'goToEditProduct'])->name('seller.product.edit')->middleware(Seller::class);
        Route::post('/update/{id}', [SellerController::class, 'updateProduct'])->name('seller.product.update');
        Route::post('/delete/{id}', [SellerController::class, 'deleteProduct'])->name('seller.product.delete');
        Route::post('/hide/{id}', [SellerController::class, 'hideProduct'])->name('seller.product.hide');
        Route::post('/unhide/{id}', [SellerController::class, 'unhideProduct'])->name('seller.product.unhide');
    });
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'goToHome'])->name('home');
    Route::get('/product/{id}', [HomeController::class, 'goToSingleProduct'])->name('home.single.product');
    Route::get('/shop', [HomeController::class, 'goToShop'])->name('home.shop');
    Route::get('/contact', [HomeController::class, 'goToContact'])->name('home.contact');
    Route::get('plant/hanging', [HomeController::class, 'goToHanginPlants'])->name('home.products.hanging');
    Route::get('plant/herb', [HomeController::class, 'goToHerbPlants'])->name('home.products.herb');
    Route::get('plant/windowsill', [HomeController::class, 'goToWindowsillPlants'])->name('home.products.windowsill');
    Route::get('plant/stands', [HomeController::class, 'goToPlantStands'])->name('home.products.stands');
    Route::get('plant/terrariums', [HomeController::class, 'goToTerrariumsPlants'])->name('home.products.terrariums');
});

Route::prefix('user')->group(function () {
    Route::prefix('add')->group(function () {
        Route::post('/cart/{id}', [UserController::class, 'addToCart'])->name('add.cart')->middleware(User::class);
        Route::get('/wishlist/{id}', [UserController::class, 'addToWishlist'])->name('add.wishlist')->middleware(User::class);
    });
    Route::prefix('remove')->group(function () {
        Route::post('/cart/{id}', [UserController::class, 'removeFromCart'])->name('remove.cart')->middleware(User::class);
        Route::get('/wishlist/{id}', [UserController::class, 'removeFromWishlist'])->name('remove.wishlist')->middleware(User::class);
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeController::class, 'goToProfile'])->name('user.profile')->middleware(User::class);
        Route::post('/update', [UserController::class, 'updateProfile'])->name('user.profile.update')->middleware(User::class);
    });
    Route::prefix('stripe')->group(function () {
        Route::post('/pay/{value}', [PaymentController::class, 'stripePay'])->name('user.stripe.pay')->middleware(User::class);
    });
    Route::get('/invoice/{orderId}', [UserController::class, 'goToInvoice'])->name('user.invoice')->middleware(User::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    // ->middleware('admin');
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminController::class, 'goToPlacedOrders'])->name('admin.order');
        Route::get('/awaiting', [AdminController::class, 'goToAwaitingShipmentOrders'])->name('admin.order.awaiting');
        Route::get('/shipped', [AdminController::class, 'goToShippedShipmentOrders'])->name('admin.order.shipped');
        Route::get('/delivered', [AdminController::class, 'goToDeliveredOrders'])->name('admin.order.delivered');
        Route::get('/cancelled', [AdminController::class, 'goToCancelledOrders'])->name('admin.order.cancelled');
        Route::get('/return', [AdminController::class, 'goToReturnOrders'])->name('admin.order.return');

        Route::post('/await/{id}', [AdminController::class, 'awaitOrder'])->name('admin.order.update.await');
        Route::post('/cancel/{id}', [AdminController::class, 'cancelOrder'])->name('admin.order.update.cancel');
        Route::post('/shipped/{id}', [AdminController::class, 'shippedOrder'])->name('admin.order.update.shipped');
        Route::post('/placed/{id}', [AdminController::class, 'placedOrder'])->name('admin.order.update.placed');
        Route::post('/delivered/{id}', [AdminController::class, 'deliveredOrder'])->name('admin.order.update.delivered');
        Route::post('/return/{id}', [AdminController::class, 'returnOrder'])->name('admin.order.update.return');
        Route::post('/return/cancel/{id}', [AdminController::class, 'cancelReturn'])->name('admin.order.update.return.cancel');

        Route::post('/stock/add/{id}/', [AdminController::class, 'addToStock'])->name('admin.order.update.add.to.stock');
        Route::post('/stock/return/add/{id}/', [AdminController::class, 'addToStockReturned'])->name('admin.order.update.add.to.stock.return');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [AdminController::class, 'goToPendingProducts'])->name('admin.products');
        Route::get('/all', [AdminController::class, 'goToAllProducts'])->name('admin.products.all');
        Route::get('/hidden', [AdminController::class, 'goToHiddenProducts'])->name('admin.products.hidden');
        Route::get('/disapproved', [AdminController::class, 'goToDisapprovedProducts'])->name('admin.products.disapproved');

        Route::post('/approve/{id}', [AdminController::class, 'approveProduct'])->name('admin.product.approve');
        Route::post('/disapprove/{id}', [AdminController::class, 'disapproveProduct'])->name('admin.product.disapprove');
        Route::post('/hide/{id}', [AdminController::class, 'hideProduct'])->name('admin.product.hide');
        Route::post('/pending/{id}', [AdminController::class, 'pendingProduct'])->name('admin.product.pending');
        Route::post('/unhide/{id}', [AdminController::class, 'approveProduct'])->name('admin.product.unhide');
        Route::post('/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'goToAllUsers'])->name('admin.users');
        Route::get('/suspended', [AdminController::class, 'goToSuspendedUsers'])->name('admin.users.suspended');
        Route::get('/banned', [AdminController::class, 'goToBannedUsers'])->name('admin.users.banned');

        Route::post('/suspend/{id}', [AdminController::class, 'suspendUser'])->name('admin.user.suspend');
        Route::post('/ban/{id}', [AdminController::class, 'banUser'])->name('admin.user.ban');
        Route::post('/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
        Route::post('/unsuspend/{id}', [AdminController::class, 'unsuspendUser'])->name('admin.user.unsuspend');
        Route::post('/unban/{id}', [AdminController::class, 'unsuspendUser'])->name('admin.user.unban');
    });

    Route::prefix('sellers')->group(function () {
        // sellers routes
        Route::get('/', [AdminController::class, 'goToAllSellers'])->name('admin.sellers');
        // make
    });
});

Route::get('/cart', [HomeController::class, 'goToCart'])->name('cart')->middleware(User::class)->middleware(User::class);
Route::get('/wishlist', [HomeController::class, 'goToWishlist'])->name('wishlist')->middleware(User::class)->middleware(User::class);

require __DIR__ . '/auth.php';
