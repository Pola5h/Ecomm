<?php

namespace App\Http\Controllers\frontend;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\BillingInformation;
use App\Models\ShippingInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{

    public function stripe()
    {


        return view("frontend.stripe.stripe");
    }

    public function stripePost(Request $request)
    {

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $order = new Order();
        $order->order_id = uniqid();

        // Check for payment type and handle payment accordingly
        if ($request->payment_type == 2) {
            // Process Stripe payment
            try {
                if (!Auth::check()) {
                    throw new Exception('Unauthorized access');
                }

                $charge = Charge::create([
                    "amount" => floatval(Cart::instance('cart')->total()), // Amount in cents
                    "currency" => "USD",
                    "source" => $request->stripeToken,
                    "description" => "Payment for testing purpose", // Use a more descriptive description
                    "metadata" => [
                        "order" => $order->order_id,
                        'customer_id' => Auth::user()->id,
                        "customer_name" => Auth::user()->name, // Add user name as metadata
                        'email' => Auth::user()->email,
                        'address' => Auth::user()->address,
                    ],
                ]);

                $order->user_id = Auth::user()->id;
                $order->tran_id = $charge->id;
                $order->payment_status = 2;
                $order->payment_type = 2;

                $order->total = Cart::instance('cart')->total();
                $order->order_status = 1;
                $order->save();
        
                $items = Cart::instance('cart')->content();
        
                foreach ($items as $item) {
                    $orderItem = new OrderItem;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->id;
                    $orderItem->qty = $item->qty;
                    $orderItem->sub_total = $item->qty * $item->price;
                    $orderItem->save();
                }
        
                Cart::instance('cart')->destroy();
        
                $billing = new BillingInformation();
                $billing->order_id = $order->id;
                $billing->name = $request->b_name;
                $billing->address = $request->b_address;
                $billing->phone = $request->b_phone;
                $billing->email = $request->b_email;
                $billing->save();
        
                if ($request->shipping_status == 'yes') {
                    $shipping = new ShippingInformation();
                    $shipping->order_id = $order->id;
                    $shipping->name = $request->s_name;
                    $shipping->address = $request->s_address;
                    $shipping->phone = $request->s_phone;
                    $shipping->email = $request->s_email;
                    $shipping->save();
                }
                // Flash success message
                toastr()->success('Payment successful');
                // Redirect back to previous page
                return back();
            } catch (Exception $exception) {
                // Handle payment failure
                $order->user_id = Auth::user()->id;
                $order->payment_status = 3;
                $order->payment_type = 2;

                $order->total = Cart::instance('cart')->total();
                $order->order_status = 1;
                $order->save();
        
                $items = Cart::instance('cart')->content();
        
                foreach ($items as $item) {
                    $orderItem = new OrderItem;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->id;
                    $orderItem->qty = $item->qty;
                    $orderItem->sub_total = $item->qty * $item->price;
                    $orderItem->save();
                }
        
                Cart::instance('cart')->destroy();
        
                $billing = new BillingInformation();
                $billing->order_id = $order->id;
                $billing->name = $request->b_name;
                $billing->address = $request->b_address;
                $billing->phone = $request->b_phone;
                $billing->email = $request->b_email;
                $billing->save();
        
                if ($request->shipping_status == 'yes') {
                    $shipping = new ShippingInformation();
                    $shipping->order_id = $order->id;
                    $shipping->name = $request->s_name;
                    $shipping->address = $request->s_address;
                    $shipping->phone = $request->s_phone;
                    $shipping->email = $request->s_email;
                    $shipping->save();
                }
                toastr()->error('Payment Failed');
                return back();
            }
        } else {
            // For non-Stripe payments, set payment status and type
            $order->user_id = Auth::user()->id;
            $order->payment_status = 1;
            $order->payment_type = $request->payment_type;

            $order->total = Cart::instance('cart')->total();
            $order->order_status = 1;
            $order->save();
    
            $items = Cart::instance('cart')->content();
    
            foreach ($items as $item) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->id;
                $orderItem->qty = $item->qty;
                $orderItem->sub_total = $item->qty * $item->price;
                $orderItem->save();
            }
    
            Cart::instance('cart')->destroy();
    
            $billing = new BillingInformation();
            $billing->order_id = $order->id;
            $billing->name = $request->b_name;
            $billing->address = $request->b_address;
            $billing->phone = $request->b_phone;
            $billing->email = $request->b_email;
            $billing->save();
    
            if ($request->shipping_status == 'yes') {
                $shipping = new ShippingInformation();
                $shipping->order_id = $order->id;
                $shipping->name = $request->s_name;
                $shipping->address = $request->s_address;
                $shipping->phone = $request->s_phone;
                $shipping->email = $request->s_email;
                $shipping->save();
            }

                // Flash success message
                toastr()->success('Order successful');
                // Redirect back to previous page
                return back();
        }

    }
}
