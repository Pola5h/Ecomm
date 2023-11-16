<?php
// StripeController.php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    use OrderTrait;

    public function stripe()
    {
        return view("frontend.stripe.stripe");
    }

    public function stripePost(Request $request)
    {
        $order = new Order();
        $order->order_id = uniqid();

        if ($request->payment_type == 2) {
            return $this->processOrder($order, $request);
        } else {
            // For non-Stripe payments
            $order->user_id = Auth::user()->id;
            $order->payment_status = 1;
            $order->payment_type = $request->payment_type;

            $this->saveOrderDetails($order, $request);

            toastr()->success('Order successful');
            return redirect()->route('user.order.details', ['id' => $order->id]);
        }
    }
}
