<?php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use App\Traits\StripeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\PaypalTrait;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{



    use StripeTrait;
    use PaypalTrait;


    public function PaymentPost(Request $request)
    {
        $order = new Order();
        $order->order_id = uniqid();

        if ($request->payment_type == 2) {
            return $this->StripeprocessOrder($order, $request);
        } elseif ($request->payment_type == 3) {

            $order->payment_status = 2;
            $order->payment_type = 3;
            return $this->PaypalprocessOrder($order, $request);
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
