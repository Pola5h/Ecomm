@extends('admin.master')
@section('admin')
<div class="page-body">
    <div class="container-xl">


        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order List</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Order Id</th>
                                    <th>Transection Id</th>

                                    <th>Total</th>
                                    <th>Payment type</th>
                                    <th>Payment Status</th>
                                    <th>Order Time</th>
                                    <th>Status</th>


                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>


                                    <td>
                                        #{{$order->order_id}} </td>

                                    <td>
                                        {{ $order->payment_type == 1 ? 'Null' : '#' . $order->tran_id }}
                                    </td>
                                    <td>
                                        ${{$order->total}} </td>
                                    <td>
                                        {{ $order->payment_type == 1 ? 'On Cash' : ($order->payment_type == 2 ? 'Stripe'
                                        : ($order->payment_type == 3 ? 'Paypal' : '')) }}
                                    </td>
                                    <td>
                                        {{ $order->payment_status == 1 ? 'Panding' : ($order->payment_status == 2 ?
                                        'Paid'
                                        : '') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A d M Y') }}
                                    </td>
                                    <td>
                                        {{ $order->order_status == 1 ? 'Pending' : ($order->order_status == 2 ?
                                        'Shipped'
                                        : ($order->order_status == 3 ? 'Delivered' : '')) }} </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">

                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.order.show', $order->order_id) }}">
                                                        Invoice
                                                    </a>
                                                    <a class="dropdown-item" href="#modal-team"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-team{{ $order->id }}">Status Update
                                                    </a>
                                                    {{-- <form action="{{ route('admin.order.destroy', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            Delete
                                                        </button>
                                                    </form> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal modal-blur fade" id="modal-team{{ $order->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update order Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.order.update', ['order' => $order->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label">Status Update</label>
                                                                <select class="form-select" name="status">
                                                                    <option value="" disabled>Select status</option>
                                                                    <option value="1" {{ $order->order_status == 1 ? 'selected'
                                                                        : '' }}>Pending</option>
                                                                    <option value="2" {{ $order->order_status == 2 ? 'selected'
                                                                        : '' }}>Shipped</option>
                                                                    <option value="3" {{ $order->order_status == 3 ? 'selected'
                                                                        : '' }}>Delivered</option>
                                                                </select>
                                                            </div>
        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn me-auto"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                           
                            </tbody>
                        </table>





                    </div>
                </div>
            </div>

        </div>
    </div>

</div>



@endsection