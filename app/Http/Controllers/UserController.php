<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliveryFee;
use App\Models\Product;
use App\Models\PurchasedHistory;
use App\Models\User;
use App\Models\UserHasAddress;
use App\Models\UserProfileImage;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $cart = Cart::where(['product_id' => $id, 'user_id' => $userId])->first();
        if ($cart) {
            $cart->product_id = $id;
            $cart->qty = $request->qty;
            $cart->user_id = $userId;
            $cart->update();
        } else {
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->qty = $request->qty;
            $cart->user_id = $userId;
            $cart->save();
        }
        return redirect()->back()->with('success', 'Product Added to the Cart');
    }

    public function addToWishlist($id)
    {
        $userId = Auth::user()->id;
        $wishlist = Wishlist::where(['product_id' => $id, 'user_id' => $userId])->first();
        if (!$wishlist) {
            $wishlist = new Wishlist;
            $wishlist->product_id = $id;
            $wishlist->user_id = $userId;
            $wishlist->save();
        }
        return redirect()->back()->with('success', 'Product Added to the Wishlist');
    }

    public function removeFromWishlist($id)
    {
        $userId = Auth::user()->id;
        $wishlist = Wishlist::where(['product_id' => $id, 'user_id' => $userId])->first();
        if ($wishlist) {
            $wishlist->delete();
        }
        return redirect()->back()->with('success', 'Product Removed');
    }

    public function removeFromCart($id)
    {
        $userId = Auth::user()->id;
        $cart = Cart::where(['product_id' => $id, 'user_id' => $userId])->first();
        if ($cart) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'Product removed');
    }

    public function updateProfile(Request $request)
    {
        // dd($request);

        // "_token" => "01VtIFTsdvBMmbycKgJhijlU0ovmtEIZ0VN9hj60"
        // "fname" => "kavindu"
        // "lname" => "udara"
        // "mobile" => "0776040673"
        // "email" => "user@gmail.com"
        // "street" => "45 A in fg"

        // "city" => "0"
        // "province" => "0"
        // "zip" => "20500"
        //   "profile_img" => 
        //   Symfony\Component\HttpFoundation\File
        //   \
        //   UploadedFile {#43 ▶}

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
            return redirect()->route('user.profile')->with('error', $firstError);
        } else {

            $userId = Auth::user()->id;
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

                    if($userHasProfileImage){
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


                return redirect()->route('user.profile')->with('success', 'profile updated');
            }
        }
    }

    public function goToInvoice($orderId){
        
        $userId = Auth::user()->id;

        $histories = PurchasedHistory::where(['order_id' => $orderId, 'user_id' => $userId])->get();
        $allProducts = Product::whereIn('id', $histories->pluck('product_id'))->get();
        $userAddress = UserHasAddress::where('user_id', Auth::user()->id)->get();
        $deliverFees = DeliveryFee::all();

        $delivery = null;

        if ($userAddress[0]->city_id == 25) {
            $delivery = $deliverFees[0]->price;
        } else {
            $delivery = $deliverFees[1]->price;
        }

        return view('invoice', compact('histories', 'orderId', 'allProducts', 'delivery'));
    }

    
    public function goToUserBanned(){
        return view("user.bannedAccount");
    }
    public function goToUserSuspended(){
        return view("user.suspendedAccount");
    }
}
