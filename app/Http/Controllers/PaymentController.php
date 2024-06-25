<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMailer;
use App\Models\Cart;
use App\Models\Product;
use App\Models\PurchasedHistory;
use App\Models\UserHasAddress;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Stripe;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function stripePay(Request $request, $value){

        $userId = Auth::user()->id;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $value * 100,
            "currency" => "usd",
            "source" => 'tok_visa', // Replace with a test token
            "description" => "Test Payment Complete"
        ]);

        $userId = Auth::user()->id;
        $name = Auth::user()->name;
        $address = Auth::user()->address;

        $address = UserHasAddress::where('user_id', $userId)->first()->line;

        $phone = Auth::user()->mobile;

        $cart = Cart::where('user_id', $userId)->get();

        $orderID =  date('YmdHis') . rand(100, 999);

        foreach ($cart as $carts) {
            $order = new PurchasedHistory;

            $order->order_id = $orderID;

            $order->qty = $carts->qty;
            $order->status = 0;
            $order->product_id = $carts->product_id;
            $order->user_id = $userId;

            $order->save();

            $product = Product::where('id', $carts->product_id)->get()->first();
            $product->qty = $product->qty - $carts->qty;
            $product->update();
        }

        $cart_remove = Cart::where('user_id', $userId)->get();

        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);
            $data->delete();
        }

        // $pdf = PDF::loadRoute('user.invoice', ['orderId' => $orderID]);
        // $content = $pdf->output();
        // $content = base64_encode($content);
        // $content = 'data:application/pdf;base64,' . $content;

        // send order success mail
        Mail::to(Auth::user()->email)->send(new InvoiceMailer($orderID));
        
        return redirect()->route('user.invoice', ['orderId' => $orderID]);

    }
}
