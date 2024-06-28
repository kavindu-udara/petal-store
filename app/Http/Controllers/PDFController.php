<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchasedHistory;
use App\Models\User;
use App\Models\UserHasAddress;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to Laravel PDF Demo', 'date' => date('m/d/Y')];

        $pdf = PDF::loadView('admin.pdf.pdf_view', $data);

        return $pdf->download('document.pdf');
    }

    public function getPlacedOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '0')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Placed Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('placed_orders' . date('Y-m-d') . '.pdf');
    }

    public function getAwaitingOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '1')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Awaiting Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('awaiting_orders' . date('Y-m-d') . '.pdf');
    }

    public function getShippedOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '2')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Shipped Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('shipped_orders' . date('Y-m-d') . '.pdf');
    }

    public function getDeliveredOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '3')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Delivered Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('delivered_orders' . date('Y-m-d') . '.pdf');
    }

    public function getCancelledOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '4')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Cancelled Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('cancelled_orders' . date('Y-m-d') . '.pdf');
    }

    public function getReturnOrdersPDF()
    {

        $orders = PurchasedHistory::where('status', '5')->get();
        $allProducts = Product::whereIn('id', $orders->pluck('product_id'))->get();
        $userAddress = UserHasAddress::whereIn('user_id', $orders->pluck('user_id'))->get();

        $title = 'Return Requested Orders';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.placed_orders', compact('orders', 'allProducts', 'userAddress', 'date', 'title', 'time'));

        return $pdf->download('return_orders' . date('Y-m-d') . '.pdf');
    }

    // products
    public function getPendingProductsPDF()
    {
        $products = Product::where('status', 0)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        $title = 'Pending Products';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.products', compact('products', 'categories', 'sellers', 'date', 'title', 'time'));
        return $pdf->download('pending_products_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getAllProductsPDF(){

        $products = Product::where('status', 1)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        $title = 'All Products';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.products', compact('products', 'categories', 'sellers', 'date', 'title', 'time'));
        return $pdf->download('all_products_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getHiddenProductsPDF(){

        $products = Product::where('status', 2)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        $title = 'Hidden Products';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.products', compact('products', 'categories', 'sellers', 'date', 'title', 'time'));
        return $pdf->download('hidden_products_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getDisapprovedProductsPDF(){

        $products = Product::where('status', 3)->get();
        $categories = Category::all();
        $sellers = Seller::all();
        $title = 'Disapproved Products';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.products', compact('products', 'categories', 'sellers', 'date', 'title', 'time'));
        return $pdf->download('disapproved_products_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getAllBuyersPDF(){
        $users = User::where('status', 0)->get();
        $title = 'All Buyers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.buyers', compact('users', 'date', 'title', 'time'));
        return $pdf->download('all_buyers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getSuspendedBuyersPDF(){

        $users = User::where('status', 1)->get();
        $title = 'Suspended Buyers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.buyers', compact('users', 'date', 'title', 'time'));
        return $pdf->download('suspended_buyers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getBannedBuyersPDF(){

        $users = User::where('status', 2)->get();
        $title = 'Banned Buyers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.buyers', compact('users', 'date', 'title', 'time'));
        return $pdf->download('banned_buyers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    // seller
    public function getPendingSellersPDF(){
        $sellers = Seller::where('status', 0)->get();
        $title = 'Pending Sellers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.sellers', compact('sellers', 'date', 'title', 'time'));
        return $pdf->download('pending_sellers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }
    public function getAllSellersPDF(){

        $sellers = Seller::where('status', 1)->get();
        $title = 'All Sellers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.sellers', compact('sellers', 'date', 'title', 'time'));
        return $pdf->download('all_sellers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }
    public function getSuspendedSellersPDF(){

        $sellers = Seller::where('status', 2)->get();
        $title = 'Suspended Sellers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.sellers', compact('sellers', 'date', 'title', 'time'));
        return $pdf->download('suspended_sellers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getBannedSellersPDF(){

        $sellers = Seller::where('status', 3)->get();
        $title = 'Banned Sellers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.sellers', compact('sellers', 'date', 'title', 'time'));
        return $pdf->download('banned_sellers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }

    public function getDisapprovedSellersPDF(){

        $sellers = Seller::where('status', 4)->get();
        $title = 'Disapproved Sellers';
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $pdf = PDF::loadView('admin.pdf.sellers', compact('sellers', 'date', 'title', 'time'));
        return $pdf->download('disapproved_sellers_' . date('Y-m-d') . '_' . $time . '.pdf');
    }


}
