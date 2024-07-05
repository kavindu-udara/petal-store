<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductsImage;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\DeliveryFee;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\UserHasAddress;
use App\Models\UserProfileImage;

class HomeController extends Controller
{
    public function index()
    {
        return view("index");
    }
    public function goToHome()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $products = Product::limit(10)->get();
        $productImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view("home", compact("products", "productImages", 'cartCount', 'wishlistCount'));
    }

    public function goToSingleProduct($id)
    {
        $product = Product::find($id);

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $wishlist = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $wishlist = Wishlist::where(['product_id' => $product->id, 'user_id' => $userId])->first();
        }

        $cart = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $cart = Cart::where(['product_id' => $id, 'user_id' => $userId])->first();
        }

        $randomProducts = Product::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
        $productImages = ProductsImage::where('product_id', $product->id)->get();
        $allProductImages = ProductsImage::all();
        return view('single_product', compact('product', 'productImages', 'randomProducts', 'allProductImages', 'wishlist', 'cart', 'cartCount', 'wishlistCount'));
    }

    public function goToShop()
    {
        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        $products = Product::paginate(10);
        $dealsProducts = Product::orderBy('price', 'ASC')->limit(6)->get();
        $allProductImages = ProductsImage::all();
        return view('shop', compact('products', 'dealsProducts', 'allProductImages', 'cartCount', 'wishlistCount'));
    }
    public function goToContact()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        return view('contact', compact('cartCount', 'wishlistCount'));
    }

    public function goToHanginPlants()
    {


        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $products = Product::where('category_id', 1)->paginate(10);
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view('hangingPlants', compact('products', 'allProductImages', 'cartCount', 'wishlistCount'));
    }

    public function goToHerbPlants()
    {


        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        $products = Product::where('category_id', 2)->paginate(10);
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view('herbPlants', compact('products', 'allProductImages', 'cartCount', 'wishlistCount'));
    }

    public function goToWindowsillPlants()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        $products = Product::where('category_id', 3)->paginate(10);
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view('windowsillPlants', compact('products', 'allProductImages', 'cartCount', 'wishlistCount'));
    }

    public function goToPlantStands()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        $products = Product::where('category_id', 4)->paginate(10);
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view('planterWithLegs', compact('products', 'allProductImages', 'cartCount', 'wishlistCount'));
    }

    public function goToTerrariumsPlants()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        $products = Product::where('category_id', 5)->paginate(10);
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        return view('tarrariums', compact('products', 'allProductImages', 'cartCount', 'wishlistCount'));
    }

    public function goToCart()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $allProductImages = ProductsImage::whereIn('product_id', $carts->pluck('product_id'))->get();
        $allProducts = Product::whereIn('id', $carts->pluck('product_id'))->get();

        $userAddress = UserHasAddress::where('user_id', Auth::user()->id)->get();
        $deliverFees = DeliveryFee::all();

        $delivery = null;

        if ($userAddress[0]->city_id == 25) {
            $delivery = $deliverFees[0]->price;
        } else {
            $delivery = $deliverFees[1]->price;
        }

        return view('cart', compact('cartCount', 'wishlistCount', 'carts', 'allProductImages', 'allProducts', 'delivery'));
    }

    public function goToWishlist()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();

        $allProductImages = ProductsImage::whereIn('product_id', $wishlist->pluck('product_id'))->get();
        $allProducts = Product::whereIn('id', $wishlist->pluck('product_id'))->get();

        return view('wishlist', compact('cartCount', 'wishlistCount', 'wishlist', 'allProductImages', 'allProducts', 'carts'));
    }

    public function goToProfile()
    {

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }

        $wishlistCount = null;
        if (Auth::user()) {
            $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }

        $userId = Auth::user()->id;
        $profile = User::where(['id' => $userId])->first();

        $profileImage = UserProfileImage::where('user_id', $userId)->get();

        $cities = City::all();
        $provinces = Province::all();
        $districts = District::all();

        $userAddress = UserHasAddress::where('user_id', $userId)->first();

        return view("user.profile", compact('profile', 'cartCount', 'wishlistCount', 'cities', 'provinces', 'districts', 'profileImage', 'userAddress'));
    }

    public function goToAdvancedSearch(Request $request)
    {
        $data = $request->query();

        // dd($data);
        // http://127.0.0.1:8000/home/advanced-search?_token=D49JpaSiin6B0KUSiKhlKXcPeLWKBn8s6LQkPqVZ&
        // text=665fbaae74005
        // &category=1
        // &dateFrom=2024-07-25&dateTo=2024-07-25
        // &priceFrom=456&priceTo=456
        // &sort=2

        $productsQuery = Product::query();

        if (isset($data['text'])) {
            $productsQuery->where('title', 'like', '%' . $data['text'] . '%');
        }

        if (isset($data['category'])) {
            $productsQuery->where('category_id', $data['category']);
        }

        if (isset($data['dateFrom'])) {
            $productsQuery->where('created_at', '>=', $data['dateFrom']);
        }

        if (isset($data['dateTo'])) {
            $productsQuery->where('created_at', '<=', $data['dateTo']);
        }

        if (isset($data['priceFrom'])) {
            $productsQuery->where('price', '>=', $data['priceFrom']);
        }

        if (isset($data['priceTo'])) {
            $productsQuery->where('price', '<=', $data['priceTo']);
        }

        if (isset($data['sort'])) {
            if ($data['sort'] == 1) {
                $productsQuery->orderBy('created_at', 'asc');
            } elseif ($data['sort'] == 2) {
                $productsQuery->orderBy('price', 'asc');
            } elseif ($data['sort'] == 3) {
                $productsQuery->orderBy('price', 'desc');
            }
        }

        $products = $productsQuery->get();
        $allProductImages = ProductsImage::whereIn('product_id', $products->pluck('id'))->get();
        $categories = Category::all();
        return view('advancedSearch', compact('categories', 'products', 'allProductImages'));
    }
}
