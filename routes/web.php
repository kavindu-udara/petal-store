<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Seller;
use App\Http\Middleware\User;
use App\Http\Controllers\PDFController;

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

    
    Route::prefix('orders')->group(function () {
        Route::get('/', [SellerController::class, 'goToNewOrders'])->name('seller.orders.new')->middleware(Seller::class);
        Route::get('/awaiting', [SellerController::class, 'goToAwaitingOrders'])->name('seller.orders.awaiting')->middleware(Seller::class);

        Route::post('/await/{id}', [SellerController::class, 'awaitOrder'])->name('seller.order.await');
        Route::post('/ship/{id}', [SellerController::class, 'shipOrder'])->name('seller.order.ship');

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
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(Admin::class);
    // ->middleware('admin');
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminController::class, 'goToPlacedOrders'])->name('admin.order')->middleware(Admin::class);
        Route::get('/awaiting', [AdminController::class, 'goToAwaitingShipmentOrders'])->name('admin.order.awaiting');

        Route::get('/shipped', [AdminController::class, 'goToShippedShipmentOrders'])->name('admin.order.shipped')->middleware(Admin::class);

        Route::get('/delivered', [AdminController::class, 'goToDeliveredOrders'])->name('admin.order.delivered')->middleware(Admin::class);

        Route::get('/cancelled', [AdminController::class, 'goToCancelledOrders'])->name('admin.order.cancelled')->middleware(Admin::class);

        Route::get('/return', [AdminController::class, 'goToReturnOrders'])->name('admin.order.return')->middleware(Admin::class);

        Route::post('/await/{id}', [AdminController::class, 'awaitOrder'])->name('admin.order.update.await')->middleware(Admin::class);
        Route::post('/cancel/{id}', [AdminController::class, 'cancelOrder'])->name('admin.order.update.cancel')->middleware(Admin::class);
        Route::post('/shipped/{id}', [AdminController::class, 'shippedOrder'])->name('admin.order.update.shipped')->middleware(Admin::class);
        Route::post('/placed/{id}', [AdminController::class, 'placedOrder'])->name('admin.order.update.placed')->middleware(Admin::class);
        Route::post('/delivered/{id}', [AdminController::class, 'deliveredOrder'])->name('admin.order.update.delivered')->middleware(Admin::class);
        Route::post('/return/{id}', [AdminController::class, 'returnOrder'])->name('admin.order.update.return')->middleware(Admin::class);
        Route::post('/return/cancel/{id}', [AdminController::class, 'cancelReturn'])->name('admin.order.update.return.cancel')->middleware(Admin::class);

        Route::post('/stock/add/{id}/', [AdminController::class, 'addToStock'])->name('admin.order.update.add.to.stock')->middleware(Admin::class);
        Route::post('/stock/return/add/{id}/', [AdminController::class, 'addToStockReturned'])->name('admin.order.update.add.to.stock.return')->middleware(Admin::class);
    })->middleware(Admin::class);

    Route::prefix('products')->group(function () {
        Route::get('/', [AdminController::class, 'goToPendingProducts'])->name('admin.products')->middleware(Admin::class);

        Route::get('/all', [AdminController::class, 'goToAllProducts'])->name('admin.products.all')->middleware(Admin::class);
        Route::get('/hidden', [AdminController::class, 'goToHiddenProducts'])->name('admin.products.hidden')->middleware(Admin::class);
        Route::get('/disapproved', [AdminController::class, 'goToDisapprovedProducts'])->name('admin.products.disapproved')->middleware(Admin::class);

        Route::post('/approve/{id}', [AdminController::class, 'approveProduct'])->name('admin.product.approve')->middleware(Admin::class);
        Route::post('/disapprove/{id}', [AdminController::class, 'disapproveProduct'])->name('admin.product.disapprove')->middleware(Admin::class);
        Route::post('/hide/{id}', [AdminController::class, 'hideProduct'])->name('admin.product.hide')->middleware(Admin::class);
        Route::post('/pending/{id}', [AdminController::class, 'pendingProduct'])->name('admin.product.pending')->middleware(Admin::class);
        Route::post('/unhide/{id}', [AdminController::class, 'approveProduct'])->name('admin.product.unhide')->middleware(Admin::class);
        Route::post('/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete')->middleware(Admin::class);
    })->middleware(Admin::class);

    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'goToAllUsers'])->name('admin.users')->middleware(Admin::class);
        Route::get('/suspended', [AdminController::class, 'goToSuspendedUsers'])->name('admin.users.suspended')->middleware(Admin::class);
        Route::get('/banned', [AdminController::class, 'goToBannedUsers'])->name('admin.users.banned')->middleware(Admin::class);

        Route::post('/suspend/{id}', [AdminController::class, 'suspendUser'])->name('admin.user.suspend')->middleware(Admin::class);
        Route::post('/ban/{id}', [AdminController::class, 'banUser'])->name('admin.user.ban')->middleware(Admin::class);
        Route::post('/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete')->middleware(Admin::class);
        Route::post('/unsuspend/{id}', [AdminController::class, 'unsuspendUser'])->name('admin.user.unsuspend')->middleware(Admin::class);
        Route::post('/unban/{id}', [AdminController::class, 'unsuspendUser'])->name('admin.user.unban')->middleware(Admin::class);

        // edit buyer
        Route::get('/edit/{id}', [AdminController::class, 'goToEditUser'])->name('admin.user.edit')->middleware(Admin::class);
        Route::post('/update/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update')->middleware(Admin::class);

    })->middleware(Admin::class);

    Route::prefix('sellers')->group(function () {
        // sellers routes
        Route::get('/', [AdminController::class, 'goToPendingSellers'])->name('admin.sellers.pending')->middleware(Admin::class);
        Route::get('/all', [AdminController::class, 'goToAllSellers'])->name('admin.sellers.all')->middleware(Admin::class);
        Route::get('/suspended', [AdminController::class, 'goToSuspendedSellers'])->name('admin.sellers.suspended')->middleware(Admin::class);
        Route::get('/banned', [AdminController::class, 'goToBannedSellers'])->name('admin.sellers.banned')->middleware(Admin::class);
        Route::get('/disapproved', [AdminController::class, 'goToDisapprovedSellers'])->name('admin.sellers.disapproved')->middleware(Admin::class);
        // make

        Route::post('/approve/{id}', [AdminController::class, 'approveSeller'])->name('admin.seller.approve')->middleware(Admin::class);
        Route::post('/disapprove/{id}', [AdminController::class, 'disapproveSeller'])->name('admin.seller.disapprove')->middleware(Admin::class);
        Route::post('/suspend/{id}', [AdminController::class, 'suspendSeller'])->name('admin.seller.suspend')->middleware(Admin::class);
        Route::post('/ban/{id}', [AdminController::class, 'banSeller'])->name('admin.seller.ban')->middleware(Admin::class);

        Route::post('/unsuspend/{id}', [AdminController::class, 'approveSeller'])->name('admin.seller.unsuspend')->middleware(Admin::class);
        Route::post('/unban/{id}', [AdminController::class, 'approveSeller'])->name('admin.seller.unban')->middleware(Admin::class);

        Route::post('/delete/{id}', [AdminController::class, 'deleteSeller'])->name('admin.seller.delete')->middleware(Admin::class);

        // edit seller
        
        Route::get('/edit/{id}', [AdminController::class, 'goToEditSeller'])->name('admin.seller.edit')->middleware(Admin::class);
        Route::post('/update/{id}', [AdminController::class, 'updateSeller'])->name('admin.seller.update')->middleware(Admin::class);

    })->middleware(Admin::class);

    Route::get('/login', [AdminController::class, 'goToLogin'])->name('admin.login.form');
    route::post('/login/admin', [AdminController::class, 'login'])->name('admin.login');

    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware(Admin::class);

    // create pdf
    Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->middleware(Admin::class);

   
    Route::prefix('get_pdf')->group(function () {
        Route::prefix('orders')->group(function () {
            Route::get('/placed', [PDFController::class, 'getPlacedOrdersPDF'])->name('admin.order.pdf.placed')->middleware(Admin::class);
            Route::get('/awaiting', [PDFController::class, 'getAwaitingOrdersPDF'])->name('admin.order.pdf.awaiting')->middleware(Admin::class);
            Route::get('/shipped', [PDFController::class, 'getShippedOrdersPDF'])->name('admin.order.pdf.shipped')->middleware(Admin::class);
            Route::get('/delivered', [PDFController::class, 'getDeliveredOrdersPDF'])->name('admin.order.pdf.delivered')->middleware(Admin::class);
            Route::get('/cancelled', [PDFController::class, 'getCancelledOrdersPDF'])->name('admin.order.pdf.cancelled')->middleware(Admin::class);
            Route::get('/return', [PDFController::class, 'getReturnOrdersPDF'])->name('admin.order.pdf.return')->middleware(Admin::class);
        });
        
        Route::prefix('products')->group(function () {
            Route::get('/pending', [PDFController::class, 'getPendingProductsPDF'])->name('admin.product.pdf.pending')->middleware(Admin::class);
            Route::get('/all', [PDFController::class, 'getAllProductsPDF'])->name('admin.product.pdf.all')->middleware(Admin::class);
            Route::get('/hidden', [PDFController::class, 'getHiddenProductsPDF'])->name('admin.product.pdf.hidden')->middleware(Admin::class);
            Route::get('/disapproved', [PDFController::class, 'getDisapprovedProductsPDF'])->name('admin.product.pdf.disapproved')->middleware(Admin::class);
        });

        Route::prefix('buyesrs')->group(function () {
            Route::get('/all', [PDFController::class, 'getAllBuyersPDF'])->name('admin.buyer.pdf.all')->middleware(Admin::class);
            Route::get('/suspended', [PDFController::class, 'getSuspendedBuyersPDF'])->name('admin.buyer.pdf.suspended')->middleware(Admin::class);
            Route::get('/banned', [PDFController::class, 'getBannedBuyersPDF'])->name('admin.buyer.pdf.banned')->middleware(Admin::class);
        });

        Route::prefix('sellers')->group(function () {
            Route::get('/pending', [PDFController::class, 'getPendingSellersPDF'])->name('admin.seller.pdf.pending')->middleware(Admin::class);
            Route::get('/all', [PDFController::class, 'getAllSellersPDF'])->name('admin.seller.pdf.all')->middleware(Admin::class);
            Route::get('/suspended', [PDFController::class, 'getSuspendedSellersPDF'])->name('admin.seller.pdf.suspended')->middleware(Admin::class);
            Route::get('/banned', [PDFController::class, 'getBannedSellersPDF'])->name('admin.seller.pdf.banned')->middleware(Admin::class);
            Route::get('/disapproved', [PDFController::class, 'getDisapprovedSellersPDF'])->name('admin.seller.pdf.disapproved')->middleware(Admin::class);
        });

    });


})->middleware(Admin::class);

Route::get('/cart', [HomeController::class, 'goToCart'])->name('cart')->middleware(User::class)->middleware(User::class);
Route::get('/wishlist', [HomeController::class, 'goToWishlist'])->name('wishlist')->middleware(User::class)->middleware(User::class);

require __DIR__ . '/auth.php';
