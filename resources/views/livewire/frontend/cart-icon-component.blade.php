<div>
    <li class="relative">
        <a href="#" class="inline-flex gap-2 bg-white rounded-lg p-[11px]" id="addToCart">
            <span><svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.52087 2.97916L4.42754 3.30916L5.31029 13.8261C5.3442 14.2399 5.5329 14.6258 5.83873 14.9066C6.14457 15.1875 6.54506 15.3427 6.96029 15.3413H16.9611C17.3587 15.3418 17.7431 15.1986 18.0436 14.9383C18.344 14.6779 18.5404 14.3178 18.5965 13.9242L19.4673 7.91266C19.4905 7.75279 19.482 7.58991 19.4422 7.43333C19.4024 7.27675 19.3322 7.12955 19.2354 7.00015C19.1387 6.87074 19.0175 6.76167 18.8786 6.67917C18.7397 6.59667 18.5859 6.54235 18.426 6.51933C18.3673 6.51291 4.73371 6.50833 4.73371 6.50833"
                        stroke="#272343" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12.948 9.89542H15.4899" stroke="#272343" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.55786 18.5194C6.62508 18.5165 6.69219 18.5273 6.75515 18.551C6.81811 18.5748 6.87562 18.611 6.9242 18.6575C6.97279 18.7041 7.01145 18.76 7.03787 18.8219C7.06428 18.8837 7.0779 18.9503 7.0779 19.0176C7.0779 19.0849 7.06428 19.1515 7.03787 19.2134C7.01145 19.2753 6.97279 19.3312 6.9242 19.3777C6.87562 19.4243 6.81811 19.4605 6.75515 19.4842C6.69219 19.508 6.62508 19.5187 6.55786 19.5158C6.42942 19.5103 6.30808 19.4554 6.21914 19.3626C6.13021 19.2698 6.08057 19.1462 6.08057 19.0176C6.08057 18.8891 6.13021 18.7655 6.21914 18.6726C6.30808 18.5798 6.42942 18.5249 6.55786 18.5194Z"
                        fill="#272343" stroke="#272343" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.8988 18.5194C17.0312 18.5194 17.1583 18.5721 17.252 18.6657C17.3457 18.7594 17.3983 18.8865 17.3983 19.019C17.3983 19.1515 17.3457 19.2786 17.252 19.3723C17.1583 19.4659 17.0312 19.5186 16.8988 19.5186C16.7663 19.5186 16.6392 19.4659 16.5455 19.3723C16.4518 19.2786 16.3992 19.1515 16.3992 19.019C16.3992 18.8865 16.4518 18.7594 16.5455 18.6657C16.6392 18.5721 16.7663 18.5194 16.8988 18.5194Z"
                        fill="#272343" stroke="#272343" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <span>Cart</span>
            <span
                class="bg-dark-accents text-white rounded-full py-[3px] px-[9px] ml-1 inline-flex justify-center items-center text-[10px] leading-[100%]">{{ Cart::instance('cart')->count() }}</span>
        </a>
        <div class="cart-content">
            <ul class="p-6">
                @foreach (Cart::instance('cart')->content() as $item )

                <li class="pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1">
                            <div>
                                <img src="{{asset('product/thumbnail/'.$item->model->thumbnail)}}"
                                    alt="">
                            </div>
                            <div class="px-2">
                                <h2 class="text-gray-black"><span>{{ substr($item->model->name,0,20) }}</span>
                                    <span class="text-[#636270]">x{{ $item->qty }}</span>
                                </h2>
                                <p class="text-gray-black font-semibold mb-0">${{ $item->subtotal }}</p>
                            </div>
                        </div>
                        <div>
                            <button
                            wire:click.prevent="destroy('{{ $item->rowId }}')"   class="hover:bg-[#F0F2F3] bg-transparent p-2 hover:text-gray-black rounded-full text-[#9A9CAA] transition-all duration-500">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 10L14 14M14 14L18 10M14 14L10 18M14 14L18 18"
                                        stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </li>
             @endforeach
                <div class="flex justify-between items-center py-2 mb-4">
                    <p class="text-[#636270] text-lg">    {{ Cart::instance('cart')->count() }} {{ Cart::instance('cart')->count() > 1 ? 'Products' : 'Product' }}
                    </p>
                    <p class="text-gray-black text-xl font-medium">${{ Cart::instance('cart')->total() }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ url('cart') }}" class="btn-transparent">View Cart</a>
                    <a href="checkout-shopping.html" class="btn-primary">Checkout</a>
                </div>
            </ul>
        </div>
    </li></div>
