<?php

namespace App\Livewire\Frontend;

use App\Models\BillingInformation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingInformation;
use Livewire\Component;
use Illuminate\Http\Request;

class OrderDetailsComponent extends Component
{
    public function render(Request $request)
    {
        $Order = Order::find($request->id);
        $OrderItems = OrderItem::where('order_id', $request->id)->get();

        $billinginfo = BillingInformation::where('order_id', $request->id)->first();
        $sippinginfo = ShippingInformation::where('order_id', $request->id)->first();

        return view('livewire.frontend.order-details-component', compact('Order', 'OrderItems', 'billinginfo', 'sippinginfo'));
    }
}
