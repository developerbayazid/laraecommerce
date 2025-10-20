<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request) {

        $validated = $request->validate([
            "first_name"     => 'required|string',
            "last_name"      => "required|string",
            "email"          => "required|email",
            "phone"          => "required",
            "address"        => "required",
            "city"           => "required",
            "zip"            => "required",
            "payment_method" => 'required',
            "total"          => 'required'
        ]);

        $order = new Order();

        $order->user_id        = Auth::id();
        $order->first_name     = $validated['first_name'];
        $order->last_name      = $validated['last_name'];
        $order->email          = $validated['email'];
        $order->phone          = $validated['phone'];
        $order->address        = $validated['address'];
        $order->city           = $validated['city'];
        $order->zip            = $validated['zip'];
        $order->payment_method = $validated['payment_method'];
        $order->total          = $validated['total'];
        $order->status         = 'pending';

        $order->save();

        $carts = Cart::where('user_id', Auth::id())->get();


        foreach ($carts as $product) {
            $item = new OrderItems();
            $item->order_id = $order->id;
            $item->product_id = $product->product->id;
            $item->price = $product->product->product_price;
            $item->save();
        }

         Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('order-successful', 'The order has been successfully done!');

    }
}
