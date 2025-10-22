<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{

    public function index() {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();

        return view('admin.order.index', ['orders' => $orders]);
    }


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

        if ($request->payment_method === 'stripe') {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $validated['total'] * 100,
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Order Payment for ' . $validated['email'],
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['payment_error' => $e->getMessage()]);
            }

            if ($charge->status === 'succeeded') {

                $order = new Order();

                $order->user_id        = Auth::id();
                $order->first_name     = $validated['first_name'];
                $order->last_name      = $validated['last_name'];
                $order->email          = $validated['email'];
                $order->phone          = $validated['phone'];
                $order->address        = $validated['address'];
                $order->city           = $validated['city'];
                $order->zip            = $validated['zip'];
                $order->payment_method = 'stripe';
                $order->total          = $validated['total'];
                $order->status         = 'payment_received';

                // $order->transaction_id = $charge->id;
                $order->save();

                // Store items
                $carts = Cart::where('user_id', Auth::id())->get();
                foreach ($carts as $cart) {
                    OrderItems::create([
                        'order_id'   => $order->id,
                        'product_id' => $cart->product->id,
                        'quantity'   => $cart->quantity,
                        'price'      => $cart->product->product_price,
                    ]);
                }

                $carts = Cart::where('user_id', Auth::id())->get();


                foreach ($carts as $product) {
                    $item             = new OrderItems();
                    $item->order_id   = $order->id;
                    $item->product_id = $product->product->id;
                    $item->price      = $product->product->product_price;
                    $item->save();
                }

                Cart::where('user_id', Auth::id())->delete();

                return redirect()->back()->with('order-successful', 'The order has been successfully done!');
            }
        }


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
            $item             = new OrderItems();
            $item->order_id   = $order->id;
            $item->product_id = $product->product->id;
            $item->price      = $product->product->product_price;
            $item->save();
        }

         Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('order-successful', 'The order has been successfully done!');

    }

    public function view($id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.product')->firstOrFail();

        return view('admin.order.view', ['order' => $order]);
    }

    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('delete-order', 'The order has been deleted successfully!');
    }

    public function edit($id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.product')->firstOrFail();

        return view('admin.order.update', ['order' => $order]);
    }

    public function update(Request $request, $id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'phone'      => 'required',
            'email'      => 'required|email',
            'status'     => 'required',
            'address'    => 'required',
            'total'      => 'required',
        ]);

        $order->update($validated);

        return redirect()->back()->with('order-update', 'The order has been updated successfully!');
    }

    public function invoice($id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('items.product')->firstOrFail();
        $pdf = Pdf::loadView('admin.order.invoice', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }


}
