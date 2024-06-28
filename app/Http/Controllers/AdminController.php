<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\PurchasedHistory;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserHasAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
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
    public function goToPendingProducts(){
        $products = Product::where('status', 0)->get();

        $categories = Category::all();

        $sellers = Seller::all();

        return view('admin.pending-products', compact('products', 'categories', 'sellers'));
    }
    public function goToAllProducts(){
        $products = Product::where('status', 1)->get();

        $categories = Category::all();

        $sellers = Seller::all();

        return view('admin.all-products', compact('products', 'categories', 'sellers'));
    }
    public function goToHiddenProducts(){
        $products = Product::where('status', 2)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        return view('admin.hidden-products', compact('products', 'categories', 'sellers'));
    }
    public function goToDisapprovedProducts(){
        $products = Product::where('status', 3)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        return view('admin.disapproved-products', compact('products', 'categories', 'sellers'));
    }

    public function approveProduct($id){
        Product::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Product Approved Successfully');
    }
    public function disapproveProduct($id){
        Product::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Product Disapproved Successfully');
    }
    public function hideProduct($id){
        Product::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Product Disapproved Successfully');
    }
    public function pendingProduct($id){
        Product::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteProduct($id){
        Product::where('id', $id)->update([
            'status' => 4,
        ]);
        return redirect()->back()->with('success', 'Success');
    }


    // Users
    public function goToAllUsers(){

        $users = User::where('status', 0)->get();

        return view('admin.all-users', compact('users'));
    }
    public function goToSuspendedUsers(){

        $users = User::where('status', 1)->get();

        return view('admin.suspended-users', compact('users'));
    }
    public function goToBannedUsers(){

        $users = User::where('status', 2)->get();

        return view('admin.banned-users', compact('users'));
    }
    public function suspendUser($id){
        User::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function banUser($id){
        User::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteUser($id){
        User::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function unsuspendUser($id){
        User::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    // sellers
    public function goToAllSellers(){
        $sellers = Seller::where('status', 1)->get();
        return view('admin.all-sellers', compact('sellers'));
    }

    public function goToPendingSellers(){

        $sellers = Seller::where('status', 0)->get();
        return view('admin.pending-sellers', compact('sellers'));
    }

    public function approveSeller($id){

        Seller::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function disapproveSeller($id){
        Seller::where('id', $id)->update([
            'status' => 4,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function goToSuspendedSellers(){
        $sellers = Seller::where('status', 2)->get();
        return view('admin.suspended-sellers', compact('sellers'));
    }

    public function goToBannedSellers(){
        $sellers = Seller::where('status', 3)->get();
        return view('admin.banned-sellers', compact('sellers'));
    }

    public function goToDisapprovedSellers(){   
        $sellers = Seller::where('status', 4)->get();
        return view('admin.disapproved-sellers', compact('sellers'));
    }

    public function suspendSeller($id){
        Seller::where('id', $id)->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function banSeller($id){
        Seller::where('id', $id)->update([
            'status' => 3,
        ]);
        return redirect()->back()->with('success', 'Success');
    }
    public function deleteSeller($id){
        Seller::where('id', $id)->update([
            'status' => 5,
        ]);
        return redirect()->back()->with('success', 'Success');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form')->with('success', 'Logout Success');
    }

    public function goToLogin(){
        return view('admin.login');
    }

    public function login(Request $request){

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

}
