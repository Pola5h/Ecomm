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
                <span class="text-[14px] font-medium leading-[110%] font-display text-gray-black inline-block">Account
                    Settings</span>
            </div>

            <h2 class="pt-[13.5px] xl:text-2xl text-[18px] font-semibold text-gray-black font-display">Account Settings
            </h2>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- user menu start -->
    <div class="user bg-red-600">
        <div class="container">
            <div class="usermenu flex flex-col md:flex-row justify-between md:items-center">
                <!-- Tabs -->
                <ul id="tabs" class="inline-flex flex-col md:flex-row w-full">

                    <li class="border-b-2 border-accents">
                        <a id="default-tab" href="#account_settings"
                            class="text-[#636270] font-medium p-5 border-b border-transparent hover:text-gray-black font-display">Account
                            Settings</a>
                    </li>

                    <li>
                        <a href="#order_history"
                            class="text-[#636270] font-medium p-5 border-b border-transparent hover:text-gray-black font-display">Order
                            History</a>
                    </li>

                
                </ul>
                <a href="#"
                    class="font-display text-[16px] leading-[110%] font-medium capitalize text-[#636270] px-4 py-4 md:px-0">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Tab Contents -->
        <div id="tab-contents">

       

            @livewire('frontend.account-component')

            <!-- order History start -->
            <div id="order_history" class="hidden p-4">
                <div class="container">
                    <div class="shopping-cart-wrapper pt-10 pb-20 flex items-start gap-6">
                        <!-- shopping cart start -->
                        <div class="shopping-cart w-full">
                            <div class="px-6 py-6 overflow-x-auto">
                                <table class="min-w-[1240px] w-full leading-normal">
                                    <thead>
                                        <tr class="">
                                            <th
                                                class="pb-6 border-b border-[#E1E3E6] text-left text-xs font-semibold text-[#272343] uppercase tracking-wider w-[160px]">
                                                Order
                                            </th>
                                            <th
                                                class="pb-6 border-b border-[#E1E3E6] text-left text-xs font-semibold text-[#272343] uppercase tracking-wider w-[200px]">
                                                Date
                                            </th>
                                            <th
                                                class="pb-6 border-b border-[#E1E3E6] text-left text-xs font-semibold text-[#272343] uppercase tracking-wider w-[140px]">
                                                Total Product
                                            </th>
                                            <th
                                                class="pb-6 border-b border-[#E1E3E6] text-left text-xs font-semibold text-[#272343] uppercase tracking-wider w-[120px]">
                                                Toral price
                                            </th>
                                            <th
                                                class="pb-6 border-b border-[#E1E3E6] text-left text-xs font-semibold text-[#272343] uppercase tracking-wider w-[100px]">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ( $orderData as $order )
                                        <tr>
                                            <td class="py-6 text-sm">
                                                <a href="{{ route('user.order.details', ['id' => $order->id]) }}"
                                                    class="text-[#007580] text-[14px] block font-display leading-[120%]  font-medium ">#{{ $order->order_id }}</a>
                                            </td>
                                            <td class="py-6 text-sm text-[#272343]">
                                                <a href="#" class="mb-0 block">{{$order->created_at->format('M j, Y')}}

                                                </a>
                                            </td>
                                            <td class="py-6 text-sm text-[#272343]">
                                                <a href="#" class="block">{{ \App\Models\OrderItem::where('order_id', $order->id)->count() }}                                                </a>
                                            </td>
                                            <td class="py-6 text-sm text-[#272343]">
                                                <a href="#" class="block">${{ $order->total }}</a>
                                            </td>
                                            <td class="py-6 text-sm">
                                                @if ($order->order_status==1)
                                                <a href="#"
                                                    class="btn-warning px-3 py-2 inline-block text-[#F5813F] text-[14px] leading-[120%] font-display">Pending</a>
                                                    @elseif ($order->order_status==2)
                                                    <a href="#"
                                                    class="btn-success2 px-3 py-2 inline-block text-[#01AD5A] text-[14px] leading-[120%] font-display">Shipped</a>
                                                    @elseif ($order->order_status==3)
                                                    <a href="#"
                                                    class="btn-success2 px-3 py-2 inline-block text-[#01AD5A] text-[14px] leading-[120%] font-display">Delevered</a>
                                                    @elseif ($order->order_status==4)
                                                    <a href="#"
                                                    class="btn-warning px-3 py-2 inline-block text-[#F5813F] text-[14px] leading-[120%] font-display">Canceled</a>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                   
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order History end -->

          
           

        </div>
    </div>
    <script>
        //tab section
        let tabsContainer = document.querySelector("#tabs");
        let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

        console.log(tabTogglers);

        tabTogglers.forEach(function(toggler) {
            toggler.addEventListener("click", function(e) {
                e.preventDefault();

                let tabName = this.getAttribute("href");
                
                let tabContents = document.querySelector("#tab-contents");

                for (let i = 0; i < tabContents.children.length; i++) {

                    tabTogglers[i].parentElement.classList.remove("border-accents", "border-b-2");
                    tabContents.children[i].classList.remove("hidden");
                    if ("#" + tabContents.children[i].id === tabName) {
                        continue;
                    }
                    tabContents.children[i].classList.add("hidden");

                }
                e.target.parentElement.classList.add("border-b-2", "border-accents",  );
            });
        });


const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
  realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
  if (realFileBtn.value) {
    customTxt.innerHTML = realFileBtn.value.match(
      /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
  } else {
    customTxt.innerHTML = "No file chosen, yet.";
  }
});

//image preview
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#blah')
            .attr('src', e.target.result);
    };

                reader.readAsDataURL(input.files[0]);
            }
            console.log(ïnput.files);
        }
    </script>
</div>