<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BillingInformation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order.index_order', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order_id)
    {


        $orderData = Order::where('order_id', $order_id)->first();
        $orderTableid = Order::where('order_id', $order_id)->value('id');
        $billingInfo = BillingInformation::where('order_id', $orderTableid)->first();
        $orderItem = OrderItem::where('order_id', $orderTableid)->get();
        return view('admin.order.invoice_order', compact('orderData', 'billingInfo', 'orderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = Order::findorfail($id);


        if ($data->payment_type == 1) {


            if ($request->status == 3) {

                $data->payment_status = 2;

                $data->order_status = $request->input('status');
                $data->save();

                toastr()->success('Status Updated successfully');
                return redirect()->back();
            } else {




                $data->payment_status = 1;

                $data->order_status = $request->input('status');
                $data->save();

                toastr()->success('Status Updated successfully');
                return redirect()->back();
            }
        } else {


            $data->order_status = $request->input('status');
            $data->save();

            toastr()->success('Status Updated successfully');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
