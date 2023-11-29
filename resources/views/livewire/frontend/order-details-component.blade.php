<div>
    <!-- Breadcrumb Start -->
    <div class="breadcrumb">
        <div class="container">
            <div class="flex items-center gap-1 py-[1.5px]">
                <a href="#" class="text-[14px] font-normal leading-[110%] text-dark-gray">Home</a>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <a href="#" class="text-[14px] font-normal leading-[110%] text-dark-gray">Account</a>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="text-[14px] font-medium leading-[110%] font-display text-gray-black inline-block">Order
                    Details</span>
            </div>

            <h2 class="pt-[13.5px] xl:text-2xl text-[18px] font-semibold text-gray-black font-display">Order Details
            </h2>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <div class="container">
        <!-- Tab Contents -->
        <div id="tab-contents">
            <!-- Order Details start -->
            <div class="p-4">
                <div class="container pt-10 pb-20">
                    <div class="box">
                        <div class="">
                            <div class="flex flex-wrap justify-between items-center px-8 py-[30px]">
                                <h2
                                    class="text-[#272343] font-display xl:text-[32px] text-[18px] font-semibold leading-[110%] capitalize">
                                    Order Details</h2>
                                <a href="account-setting.html" class="btn-primary capitalize">back to List</a>
                            </div>
                            <hr class="my-0">
                            <div
                                class="px-8 py-8 flex flex-col md:flex-row md:flex-wrap gap-6 xl:gap-2 xl:justify-between md:items-center">
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Order ID:</p>
                                    <span
                                        class="text-gray-black font-display text-[20px] leading-[120%] font-medium">#{{
                                        $Order->order_id }}</span>
                                </div>
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Date:</p>
                                    <span
                                        class="text-gray-black font-display text-[20px] leading-[120%] font-medium">{{$Order->created_at->format('M
                                        j, Y')}}</span>
                                </div>
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Email:</p>
                                    <span class="text-gray-black font-display text-[20px] leading-[120%] font-medium">{{
                                        $billinginfo->email }}</span>
                                </div>
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Total:</p>
                                    <span
                                        class="text-gray-black font-display text-[20px] leading-[120%] font-medium">${{
                                        $Order->total }}</span>
                                </div>
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Status:</p>
                                    <span class="text-gray-black font-display text-[20px] leading-[120%] font-medium">{{
                                        ['Pending', 'Shipped', 'Delivered', 'Canceled'][$Order->order_status - 1] ??
                                        'Invalid Status' }}
                                    </span>
                                </div>
                                <div class="flex-wrap">
                                    <p
                                        class="text-[#9A9CAA] font-display text-[14px] leading-[100%] capitalize pb-[10px]">
                                        Payment Method:</p>
                                    <span class="text-gray-black font-display text-[20px] leading-[120%] font-medium">{{
                                        $Order->payment_type == 1 ? "Cash On Delivery" : (
                                        $Order->payment_type == 2 ? "Stripe" : (
                                        $Order->payment_type == 3 ? "Paypal" : ""
                                        )
                                        )
                                        }}: {{ ['Pending', 'Paid', 'Failed'][$Order->payment_status - 1] ?? 'Invalid
                                        Status' }}

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="overflow-x-auto">
                                <table class="min-w-full leading-normal">
                                    <thead class="bg-off-white">
                                        <tr class="">
                                            <th
                                                class="pt-4 pb-4 px-8 border-b border-[#E1E3E6] text-left text-lg font-medium leading-[100%] text-[#272343] uppercase tracking-wider w-[305px]">
                                                Product
                                            </th>
                                            <th
                                                class="pt-4 pb-4 border-b border-[#E1E3E6] text-left text-lg font-medium leading-[100%] text-[#272343] uppercase tracking-wider w-[140px]">
                                                Price
                                            </th>
                                            <th
                                                class="pt-4 pb-4 border-b border-[#E1E3E6] text-left text-lg font-medium leading-[100%] text-[#272343] uppercase tracking-wider w-[145px]">
                                                Quantity
                                            </th>
                                            <th
                                                class="pt-4 pb-4 border-b border-[#E1E3E6] text-left text-lg font-medium leading-[100%] text-[#272343] uppercase tracking-wider w-[175px]">
                                                Subtotal
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($OrderItems as $orderItem)

                                        <tr class="">
                                            <td class="text-sm px-6 pt-6">
                                                <div class="flex justify-between items-center">
                                                    <div class="flex items-center gap-3">
                                                        <div>
                                                            {{-- <img src="{{ asset('product/thumbnail/'.\App\Models\Product::findOrFail($orderItem->product_id)->thumbnail) }}
                                                            " alt=""> --}}
                                                        </div>

                                                        <p>{{
                                                            \App\Models\Product::findOrFail($orderItem->product_id)->name
                                                            }}</p>

                                                    </div>

                                                </div>
                                            </td>
                                            <td class="text-sm">
                                                <p class="mb-0">${{ $orderItem->sub_total }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p>x{{ $orderItem->qty }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p>${{ $orderItem->sub_total }}</p>
                                            </td>

                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <hr class="my-0">

                        <div
                            class="px-8 py-8 flex flex-col md:flex-row md:flex-wrap gap-y-6 justify-between md:items-center">

                            <div>
                                <h2
                                    class="text-gray-black font-medium font-display xl:text-[32px] text-[20px] leading-[110%] capitalize ">
                                    Billing address</h2>
                                <p class="font-display text-[16px] leading-[120%] font-normal text-[#272343] pt-5 pb-2">
                                    {{ $billinginfo->name }}</p>
                                <p class="text-[#636270] text-[14px] leading-[150%] font-display font-normal pb-4">
                                    {{ $billinginfo->address }}
                                </p>
                                <p class="text-[#636270] text-[14px] leading-[100%] font-display font-normal pb-4"> {{
                                    $billinginfo->email }}
                                </p>
                                <span class="text-[#636270] text-[14px] leading-[100%] font-display font-normal"> {{
                                    $billinginfo->phone }}
                                </span>
                            </div>

                            <div>

                                @if ($sippinginfo)

                                <h2
                                    class="text-gray-black font-medium font-display xl:text-[32px] text-[20px] leading-[110%] capitalize">
                                    Shipping address</h2>
                                <p class="font-display text-[16px] leading-[120%] font-normal text-[#272343] pt-5 pb-2">
                                    {{ $sippinginfo->name }}</p>
                                <p class="text-[#636270] text-[14px] leading-[150%] font-display font-normal pb-4">
                                    {{ $sippinginfo->address }}
                                </p>
                                <p class="text-[#636270] text-[14px] leading-[100%] font-display font-normal pb-4">
                                    {{ $sippinginfo->email }}</p>
                                <span class="text-[#636270] text-[14px] leading-[100%] font-display font-normal"> {{
                                    $sippinginfo->phone }}</span>
                                @endif
                            </div>

                            <div class="px-6 py-6 bg-off-white rounded-lg max-w-[348px] w-full">
                                <div class="">

                                    <div class="flex justify-between pb-4">
                                        <p>Subtotal</p>
                                        <p>${{ $Order->total }}</p>
                                    </div>
                                    <div class="flex justify-between pb-4">
                                        <p>discount</p>
                                        <p>0%</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p>shipping</p>
                                        <p>Free</p>
                                    </div>
                                    <hr>
                                    <div class="flex justify-between">
                                        <p class="text-[18px] font-display text-dark-gray ">Total:</p>
                                        <p class="text-[22px] font-display leading-[120%] font-sem">${{ $Order->total }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Details end -->
        </div>
    </div>
    <!-- user menu end -->
</div>