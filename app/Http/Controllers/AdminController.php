<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\PurchasedHistory;
use App\Models\Seller;
use App\Models\SellerProfileImage;
use App\Models\User;
use App\Models\UserHasAddress;
use App\Models\UserProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller
{
    public function index()
    {
        

        $chart_options =
            [
                'chart_title' => 'Products qty',
                'report_type' => 'group_by_string',
                'model' => 'App\Models\Product',
                'group_by_field' => 'qty',
                'chart_type' => 'bar',
                'filter_field' => 'created_at',
                'filter_period' => 'month',
            ];

        $chart = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Users by date',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\PurchasedHistory',
            'group_by_field' => 'qty',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color ' => 'rgb(52, 211, 153)',
        ];

        $chart3 = new LaravelChart($chart_options);
        return view('admin.index', compact('chart', 'chart3'));
    }

    // Orders
    public function goToPlacedOrders()
    {
        $orders = PurchasedHistory::where('status', '0')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.placed-orders', compact('orders', 'allProducts', 'userAddress'));
    }
    public function goToAwaitingShipmentOrders()
    {
        $orders = PurchasedHistory::where('status', '1')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.awaiting-orders', compact('orders', 'allProducts', 'userAddress'));
    }
    public function goToShippedShipmentOrders()
    {
        $orders = PurchasedHistory::where('status', '2')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.shipped-orders', compact('orders', 'allProducts', 'userAddress'));
    }
    public function goToDeliveredOrders()
    {
        $orders = PurchasedHistory::where('status', '3')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.delivered-orders', compact('orders', 'allProducts', 'userAddress'));
    }
    public function goToCancelledOrders()
    {
        $orders = PurchasedHistory::whereIn('status', [4, 6])->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.cancelled-orders', compact('orders', 'allProducts', 'userAddress'));
    }
    public function goToReturnOrders()
    {
        $orders = PurchasedHistory::whereIn('status', [5, 7, 8])->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();
        return view('admin.return-orders', compact('orders', 'allProducts', 'userAddress'));
    }

    // update orders
    public function awaitOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Order Placed Successfully');
    }
    public function cancelOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 4,
        ]);
        return redirect()->back()->with('success', 'Order Cancelled Successfully');
    }
    public function shippedOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function placedOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Order Placed Successfully');
    }
    public function deliveredOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function returnOrder($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 5,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function addToStock($id)
    {
        $order = PurchasedHistory::where('id', $id)->get()[0];
        $product = Product::where('id', $order->product_id)->get()[0];
        $product->update([
            'qty' => $product->qty + $order->qty,
        ]);
        $order->update([
            'status' => 6,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function cancelReturn($id)
    {
        PurchasedHistory::where('id', $id)->update([
            'status' => 7,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function addToStockReturned($id)
    {
        $order = PurchasedHistory::where('id', $id)->get()[0];
        $product = Product::where('id', $order->product_id)->get()[0];
        $product->update([
            'qty' => $product->qty + $order->qty,
        ]);
        $order->update([
            'status' => 8,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    // Products
    public function goToPendingProducts()
    {
        $products = Product::where('status', 0)->get();

        $categories = Category::all();

        $sellers = Seller::all();

        return view('admin.pending-products', compact('products', 'categories', 'sellers'));
    }
    public function goToAllProducts()
    {
        $products = Product::where('status', 1)->get();

        $categories = Category::all();

        $sellers = Seller::all();

        return view('admin.all-products', compact('products', 'categories', 'sellers'));
    }
    public function goToHiddenProducts()
    {
        $products = Product::where('status', 2)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        return view('admin.hidden-products', compact('products', 'categories', 'sellers'));
    }
    public function goToDisapprovedProducts()
    {
        $products = Product::where('status', 3)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        return view('admin.disapproved-products', compact('products', 'categories', 'sellers'));
    }

    public function approveProduct($id)
    {
        Product::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Product Approved Successfully');
    }
    public function disapproveProduct($id)
    {
        Product::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Product Disapproved Successfully');
    }
    public function hideProduct($id)
    {
        Product::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Product Disapproved Successfully');
    }
    public function pendingProduct($id)
    {
        Product::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteProduct($id)
    {
        Product::where('id', $id)->update([
            'status' => 4,
        ]);
        return redirect()->back()->with('success', 'Success');
    }


    // Users
    public function goToAllUsers()
    {

        $users = User::where('status', 0)->get();

        return view('admin.all-users', compact('users'));
    }
    public function goToSuspendedUsers()
    {

        $users = User::where('status', 1)->get();

        return view('admin.suspended-users', compact('users'));
    }
    public function goToBannedUsers()
    {

        $users = User::where('status', 2)->get();

        return view('admin.banned-users', compact('users'));
    }
    public function suspendUser($id)
    {
        User::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function banUser($id)
    {
        User::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteUser($id)
    {
        User::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function unsuspendUser($id)
    {
        User::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    // sellers
    public function goToAllSellers()
    {
        $sellers = Seller::where('status', 1)->get();
        return view('admin.all-sellers', compact('sellers'));
    }

    public function goToPendingSellers()
    {

        $sellers = Seller::where('status', 0)->get();
        return view('admin.pending-sellers', compact('sellers'));
    }

    public function approveSeller($id)
    {

        Seller::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function disapproveSeller($id)
    {
        Seller::where('id', $id)->update([
            'status' => 4,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function goToSuspendedSellers()
    {
        $sellers = Seller::where('status', 2)->get();
        return view('admin.suspended-sellers', compact('sellers'));
    }

    public function goToBannedSellers()
    {
        $sellers = Seller::where('status', 3)->get();
        return view('admin.banned-sellers', compact('sellers'));
    }

    public function goToDisapprovedSellers()
    {
        $sellers = Seller::where('status', 4)->get();
        return view('admin.disapproved-sellers', compact('sellers'));
    }

    public function suspendSeller($id)
    {
        Seller::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function banSeller($id)
    {
        Seller::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteSeller($id)
    {
        Seller::where('id', $id)->update([
            'status' => 5,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form')->with('success', 'Logout Success');
    }

    public function goToLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $check = $request->all();

        $remember = $request->has('rememberMe');

        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']], $remember)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login Success');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }

    // edit buyer
    public function goToEditUser($id)
    {

        $profile = User::where(['id' => $id])->first();

        $profileImage = UserProfileImage::where('user_id', $id)->get();

        $cities = City::all();
        $provinces = Province::all();
        $districts = District::all();

        $userAddress = UserHasAddress::where('user_id', $id)->first();

        return view("admin.buyer.edit-user", compact('profile', 'cities', 'provinces', 'districts', 'profileImage', 'userAddress'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request);

        $messages = [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.min' => 'The first name must be at least 3 characters.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.min' => 'The last name must be at least 3 characters.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',

            'street.required' => 'The street is required.',
            'street.string' => 'The street must be a string.',
            'street.min' => 'The street must be at least 3 characters.',
            'street.max' => 'The street may not be greater than 255 characters.',

            'mobile.required' => 'The mobile number is required.',
            'mobile.string' => 'The mobile number must be a string.',
            'mobile.size' => 'The mobile number must be exactly 10 characters.',

            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address has already been taken.',

            'zip.required' => 'The zip code is required.',
            'zip.integer' => 'The zip code must be a valid zip code.',
            'zip.min' => 'The zip must be at least 3 characters.',

            'profile_image.image' => 'The profle image must be an image.',
            'profile_image.mimes' => 'The profle image must be a file of type: jpeg, png, jpg, gif, svg.',
            'profile_image.max' => 'The profle image may not be greater than 2048 kb',
        ];

        $rules = [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'mobile' => 'required|string|size:10',
            'email' => 'required|email|email',
            'street' => 'required|string|min:5|max:255',
            'zip' => 'required|integer|min:3',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->route('admin.user.edit', $id)->with('error', $firstError);
        } else {

            $userId = $id;
            $profile = User::where(['id' => $userId])->first();

            if ($profile) {

                $profile->fname = $request->first_name;
                $profile->lname = $request->last_name;
                $profile->email = $request->email;
                $profile->mobile = $request->mobile;

                $profile->update();

                $userHasAddress = UserHasAddress::where(['user_id' => $userId])->first();

                if ($userHasAddress) {
                    $userHasAddress->line = $request->street;
                    $userHasAddress->city_id = $request->city;
                    $userHasAddress->postal_code = $request->zip;
                    $userHasAddress->update();
                } else {
                    $address = new UserHasAddress();
                    $address->user_id = $userId;
                    $address->line = $request->street;
                    $address->city_id = $request->city;
                    $address->postal_code = $request->zip;
                    $address->save();
                }

                $profileImage = $request->profile_img;

                if ($profileImage) {
                    $imageName = time() . '-' . $profileImage->getClientOriginalName();
                    $profileImage->move(public_path('user/images'), $imageName);

                    $userHasProfileImage = UserProfileImage::where(['user_id' => $userId])->first();

                    if ($userHasProfileImage) {
                        $imagePath = public_path('seller/images/' . $userHasProfileImage->name);

                        // Check if the file exists
                        if (File::exists($imagePath)) {
                            // Delete the file
                            File::delete($imagePath);
                        }
                    }

                    $dataImg = [
                        'user_id' => $userId,
                        'name' => $imageName,
                    ];

                    UserProfileImage::updateOrCreate(
                        ['user_id' => $userId],
                        $dataImg
                    );
                }

                return redirect()->route('admin.user.edit')->with('success', 'profile updated');
            }
        }
    }

    public function goToEditSeller($id){
        
        $profile = Seller::where(['id' => $id])->first();
        
        $profileImage = SellerProfileImage::where('seller_id', $id)->get();

        return view("admin.seller.edit-seller", compact('profileImage', 'profile'));
    }

    public function updateSeller(Request $request, $id)
    {

        $messages = [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.min' => 'The first name must be at least 3 characters.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.min' => 'The last name must be at least 3 characters.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',

            'shop_name.required' => 'The shop name is required.',
            'shop_name.string' => 'The shop name must be a string.',
            'shop_name.min' => 'The shop name must be at least 3 characters.',
            'shop_name.max' => 'The shop name may not be greater than 255 characters.',

            'nic_no.required' => 'The NIC number is required.',
            'nic_no.string' => 'The NIC number must be a string.',
            'nic_no.size' => 'The NIC number must be exactly 12 characters.',

            'mobile.required' => 'The mobile number is required.',
            'mobile.string' => 'The mobile number must be a string.',
            'mobile.size' => 'The mobile number must be exactly 10 characters.',

            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address has already been taken.',

            'profile_image.image' => 'The profle image must be an image.',
            'profile_image.mimes' => 'The profle image must be a file of type: jpeg, png, jpg, gif, svg.',
            'profile_image.max' => 'The profle image may not be greater than 2048 kb',
        ];

        $rules = [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'shop_name' => 'required|string|min:3|max:255',
            'nic_no' => 'required|string|size:12',
            'mobile' => 'required|string|size:10',
            'email' => 'required|email|unique:users,email',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->route('admin.seller.edit', $id)->with('error', $firstError);
        } else {
            $data = Seller::find($id);
            $data->fname = $request->first_name;
            $data->lname = $request->last_name;
            $data->email = $request->email;
            $data->mobile = $request->mobile;
            $data->nic = $request->nic_no;
            $data['shop-name'] = $request->shop_name;

            $image = $request->profile_image;
            if ($image) {
                $imagename = time() . '-' . $image->getClientOriginalName();
                // $request->image->move('seller/images', $imagename);
                $image->move(public_path('seller/images'), $imagename);

                $dataImg = [
                    'seller_id' => $id,
                    'name' => $imagename,
                ];

                $imageName = SellerProfileImage::where('seller_id', $id)->first();

                $imagePath = public_path('seller/images/' . $imageName->name);

                // Check if the file exists
                if (File::exists($imagePath)) {
                    // Delete the file
                    File::delete($imagePath);
                }

                SellerProfileImage::updateOrCreate(
                    ['seller_id' => $id],
                    $dataImg
                );
            }
            $data->save();
            // return redirect('/view_product');
            return redirect()->route('admin.seller.edit', $id)->with('success', 'Profile Updated !');
        }
    }

}
