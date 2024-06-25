<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductsImage;
use App\Models\Seller;
use App\Models\SellerProfileImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function goToLogin()
    {
        return view("seller.login");
    }
    public function goToRegister()
    {
        $data = Gender::all();
        return view("seller.register", compact('data'));
    }
    public function goToProfile()
    {

        $profileImage = SellerProfileImage::where('seller_id', Auth::guard('seller')->user()->id)->get();

        // $categories = Category::all();
        // dd($categories);
        // dd($profileImage);


        // $imagePath = public_path('seller/images/' . $profileImage->name);


        // $categories = Category::all();
        // return view("seller.new", compact('categories'));
        return view("seller.profile", compact('profileImage'));
    }
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();

        $remember = $request->has('rememberMe');

        if (Auth::guard('seller')->attempt(['email' => $check['email'], 'password' => $check['password']], $remember)) {
            return redirect()->route('seller.profile')->with('success', 'Login Success');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }

    public function register(Request $request)
    {

        $messages = [
            'fname.required' => 'The first name is required.',
            'fname.string' => 'The first name must be a string.',
            'fname.min' => 'The first name must be at least 3 characters.',
            'fname.max' => 'The first name may not be greater than 255 characters.',
            'lname.required' => 'The last name is required.',
            'lname.string' => 'The last name must be a string.',
            'lname.min' => 'The last name must be at least 3 characters.',
            'lname.max' => 'The last name may not be greater than 255 characters.',
            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.min' => 'The phone number must be 10 characters.',
            'phone.max' => 'The phone number must be 10 characters.',
            'shopName.required' => 'The shop name is required.',
            'shopName.string' => 'The shop name must be a string.',
            'shopName.min' => 'The shop name must be at least 3 characters.',
            'shopName.max' => 'The shop name may not be greater than 255 characters.',
            'nic.required' => 'The NIC is required.',
            'nic.string' => 'The NIC must be a string.',
            'nic.min' => 'The NIC must be 12 characters.',
            'nic.max' => 'The NIC may not be greater than 12 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'The password is required.',
            'password.string' => 'The password must be a string.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.max' => 'The password may not be greater than 12 characters.',
        ];

        // Define the validation rules
        $rules = [
            'fname' => 'required|string|min:3|max:255',
            'lname' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:10',
            'shopName' => 'required|string|min:3|max:255',
            'nic' => 'required|string|min:12|max:12',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|string|confirmed|min:6|max:12',
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if the validation fails
        if ($validator->fails()) {
            // Get the first validation error
            $firstError = $validator->errors()->first();

            // Redirect back with the error message
            return redirect()->route('seller.register.form')->with('error', $firstError);
        } else {

            Seller::insert([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'shop-name' => $request->shopName,
                'email' => $request->email,
                'mobile' => $request->phone,
                'nic' => $request->nic,
                'password' => hash::make($request->password),
                'gender_id' => $request->gender,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('seller.login.form')->with('success', 'Account Created Success');
        }
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login.form')->with('success', 'Logout Success');
    }

    public function goToNewProduct()
    {
        $categories = Category::all();
        return view("seller.new", compact('categories'));
    }

    public function newProduct(Request $request)
    {

        $messages = [
            'product_title.required' => 'The product title is required.',
            'product_title.string' => 'The product title must be a string.',
            'product_title.min' => 'The product title must be at least 3 characters.',
            'product_title.max' => 'The product title may not be greater than 255 characters.',

            'product_description.required' => 'The product description is required.',
            'product_description.string' => 'The product description must be a string.',
            'product_description.min' => 'The product description must be at least 15 characters.',
            'product_description.max' => 'The product description may not be greater than 255 characters.',

            'product_price.required' => 'The product price is required.',
            'product_price.integer' => 'The product price must be an integer.',
            'product_price.min' => 'The product price must be at least 50.',

            'product_qty.required' => 'The product quantity is required.',
            'product_qty.integer' => 'The product quantity must be an integer.',
            'product_qty.min' => 'The product quantity must be at least 1.',

            'product_image_1.required' => 'The first product image is required.',
            'product_image_1.image' => 'The first product image must be an image.',
            'product_image_1.mimes' => 'The first product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'product_image_1.max' => 'The first product image may not be greater than 2048 kb',

            'product_image_2.required' => 'The first product image is required.',
            'product_image_2.image' => 'The first product image must be an image.',
            'product_image_2.mimes' => 'The first product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'product_image_2.max' => 'The first product image may not be greater than 2048 kb',

            'product_image_3.required' => 'The first product image is required.',
            'product_image_3.image' => 'The first product image must be an image.',
            'product_image_3.mimes' => 'The first product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'product_image_3.max' => 'The first product image may not be greater than 2048 kb',
        ];

        $rules = [
            'product_title' => 'required|string|min:3|max:255',
            'product_description' => 'required|string|min:15',
            'product_price' => 'required|integer|min:50',
            'product_qty' => 'required|integer|min:1',
            'product_image_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();

            return redirect()->route('seller.new.form')->with('error', $firstError);
        } else {

            $product = Product::create([
                'title' => $request->product_title,
                'description' => $request->product_description,
                'price' => $request->product_price,
                'qty' => $request->product_qty,
                'category_id' => $request->category,
                'seller_id' => Auth::guard('seller')->user()->id,
            ]);

            $productId = $product->id;

            $image1 = $request->product_image_1;
            $image1Name = time() . '-' . $image1->getClientOriginalName();
            $image1->move(public_path('products'), $image1Name);

            ProductsImage::insert([
                'name' => $image1Name,
                'product_id' => $productId,
            ]);

            $image2 = $request->product_image_2;
            $image2Name = time() . '-' . $image2->getClientOriginalName();
            $image2->move(public_path('products'), $image2Name);

            ProductsImage::insert([
                'name' => $image2Name,
                'product_id' => $productId,
            ]);

            $image3 = $request->product_image_3;
            $image3Name = time() . '-' . $image3->getClientOriginalName();
            $image3->move(public_path('products'), $image3Name);

            ProductsImage::insert([
                'name' => $image3Name,
                'product_id' => $productId,
            ]);
            return redirect()->route('seller.new.form')->with('success', 'Product Added');
        }
    }

    public function goToPendingProduct()
    {

        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->where('status', 0)
            ->get();

        $categories = Category::all();

        return view("seller.pending_products", compact('products', 'categories'));
    }

    public function goToProduct()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->where('status', 1)
            ->get();
        $categories = Category::all();
        return view("seller.products", compact('products', 'categories'));
    }

    public function goToHiddenProduct()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->where('status', 2)
            ->get();
        $categories = Category::all();
        return view("seller.hidden_products", compact('products', 'categories'));
    }

    public function goToDisapprovedProduct()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->where('status', 3)
            ->get();
        $categories = Category::all();
        return view("seller.disapproved_products", compact('products', 'categories'));
    }
    // goto dashboard
    public function goToDashboard()
    {
        return view('seller.dashboard');
    }

    public function updateProfile(Request $request)
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
            return redirect()->route('seller.profile')->with('error', $firstError);
        } else {
            $data = Seller::find(Auth::guard('seller')->user()->id);
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
                    'seller_id' => Auth::guard('seller')->user()->id,
                    'name' => $imagename,
                ];

                $imageName = SellerProfileImage::where('seller_id', Auth::guard('seller')->user()->id);

                $imagePath = public_path('seller/images/' . $imageName->name);

                // Check if the file exists
                if (File::exists($imagePath)) {
                    // Delete the file
                    File::delete($imagePath);
                }

                SellerProfileImage::updateOrCreate(
                    ['seller_id' => Auth::guard('seller')->user()->id],
                    $dataImg
                );
            }
            $data->save();
            // return redirect('/view_product');
            return redirect()->route('seller.profile')->with('success', 'Profile Updated !');
        }
    }

    public function goToEditProduct($id)
    {
        $product = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->where('id', $id)
            ->first();
        $categories = Category::all();
        $productImages = ProductsImage::where('product_id', $product->id)->get();
        return view("seller.edit-product", compact('product', 'categories', 'productImages'));
    }

    public function updateProduct(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:15|max:1000',
            'category' => 'required|integer|exists:categories,id',
            'price' => 'required|integer|min:1',
            'qty' => 'required|integer|min:1',
            'image_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.min' => 'The description must be at least 15 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',

            'category.required' => 'The category is required.',
            'category.integer' => 'The category must be an integer.',
            'category.exists' => 'The selected category is invalid.',

            'price.required' => 'The price is required.',
            'price.integer' => 'The price must be an integer.',
            'price.min' => 'The price must be at least 1.',

            'qty.required' => 'The quantity is required.',
            'qty.integer' => 'The quantity must be an integer.',
            'qty.min' => 'The quantity must be at least 1.',

            'image_1.image' => 'The first image must be an image.',
            'image_1.mimes' => 'The first image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image_1.max' => 'The first image may not be greater than 2048 KB.',

            'image_2.image' => 'The second image must be an image.',
            'image_2.mimes' => 'The second image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image_2.max' => 'The second image may not be greater than 2048 KB.',

            'image_3.image' => 'The third image must be an image.',
            'image_3.mimes' => 'The third image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image_3.max' => 'The third image may not be greater than 2048 KB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();

            return redirect()->route('seller.product.edit', $id)->with('error', $firstError);

        } else {

            Product::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category,
                'price' => $request -> price,
                'qty' => $request -> qty,
                'status' => 0,
            ]);

            // image update
            if ($request->image_1) {

                $image = $request->image_1;
                $imagename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('products/'), $imagename);

                $productImages = ProductsImage::where('product_id', $request->id)->get();

                $dbImgName = $productImages[0]->name;

                File::delete(public_path('products/'.$dbImgName));

                $productImages[0]->update(['name' => $imagename]);

            }

            if ($request->image_2) {

                $image = $request->image_2;
                $imagename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('products/'), $imagename);

                $productImages = ProductsImage::where('product_id', $request->id)->get();

                $dbImgName = $productImages[1]->name;

                File::delete(public_path('products/'.$dbImgName));

                $productImages[1]->update(['name' => $imagename]);

            }

            if ($request->image_3) {

                $image = $request->image_3;
                $imagename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('products/'), $imagename);

                $productImages = ProductsImage::where('product_id', $request->id)->get();

                $dbImgName = $productImages[2]->name;

                File::delete(public_path('products/'.$dbImgName));

                $productImages[2]->update(['name' => $imagename]);

            }

            return redirect()->route('seller.product.edit', $id)->with('success', 'Product Updated Success');

        }
    }

    public function deleteProduct($id){
        Product::where('id', $id)->update([
            'status' => '4',
        ]);
        return redirect()->back()->with('success', 'Product Deleted Success');
    }

    public function hideProduct($id){
        Product::where('id', $id)->update([
            'status' => '2',
        ]);
        return redirect()->back()->with('success', 'Product Hided ');
    }
    public function unhideProduct($id){
        Product::where('id', $id)->update([
            'status' => '1',
        ]);
        return redirect()->back()->with('success', 'Product Hided ');
    }
}
