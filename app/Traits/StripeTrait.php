<?php

namespace App\Traits;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\BillingInformation;
use App\Models\ShippingInformation;

trait StripeTrait
{
    public function StripeprocessOrder($order, $request)
    {
        try {
            $this->createStripeCharge($order, $request);

            $this->saveOrderDetails($order, $request);

            toastr()->success('Payment successful');
        } catch (Exception $exception) {
            $this->handlePaymentFailure($order, $request, $exception);

            toastr()->error('Payment Failed');
        }

        return redirect()->route('user.order.details', ['id' => $order->id]);
    }

    public function createStripeCharge($order, $request)
    {

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Process Stripe payment
            $charge = Charge::create([

                // "amount" => (int)(Cart::instance('cart')->total()), 
                "amount" => intval(Cart::instance('cart')->total() * 100), // Amount in cents

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

            // Update order details based on successful charge
            $order->tran_id = $charge->id;
            $order->payment_status = 2;
            $order->payment_type = 2;
        } catch (\Exception $exception) {
            // Handle exception if charge creation fails
            // You can log the exception, throw it, or handle it as needed
            throw $exception;
        }
    }

    public function saveOrderDetails($order, $request)
    {
        $order->user_id = Auth::user()->id;
        $order->total = Cart::instance('cart')->total();
        $order->order_status = 1;
        $order->save();

        $this->saveOrderItems($order);
        $this->saveBillingInformation($order, $request);

        if ($request->shipping_status == 'yes') {
            $this->saveShippingInformation($order, $request);
        }

        Cart::instance('cart')->destroy();
    }

    public function saveOrderItems($order)
    {
        $items = Cart::instance('cart')->content();

        foreach ($items as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->qty = $item->qty;
            $orderItem->sub_total = $item->qty * $item->price;
            $orderItem->save();
        }
    }

    public function saveBillingInformation($order, $request)
    {
        $billing = new BillingInformation();
        $billing->order_id = $order->id;
        $billing->name = $request->b_name;
        $billing->address = $request->b_address;
        $billing->phone = $request->b_phone;
        $billing->email = $request->b_email;
        $billing->save();
    }

    public function saveShippingInformation($order, $request)
    {
        $shipping = new ShippingInformation();
        $shipping->order_id = $order->id;
        $shipping->name = $request->s_name;
        $shipping->address = $request->s_address;
        $shipping->phone = $request->s_phone;
        $shipping->email = $request->s_email;
        $shipping->save();
    }

    public function handlePaymentFailure($order, $request, $exception)
    {
        $order->user_id = Auth::user()->id;
        $order->payment_status = 3;
        $order->payment_type = 2;

        $order->total = Cart::instance('cart')->total();
        $order->order_status = 1;
        $order->save();

        $this->saveOrderItems($order);
        $this->saveBillingInformation($order, $request);

        if ($request->shipping_status == 'yes') {
            $this->saveShippingInformation($order, $request);
        }

        throw $exception;
    }
}
