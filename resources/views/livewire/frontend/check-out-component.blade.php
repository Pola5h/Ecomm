<div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>      

  <!-- Breadcrumb Start -->
  <div class="breadcrumb">
    <div class="container px-3 md:px-5 xl:px-0">
      <div class="flex items-center gap-1 py-[1.5px]">
        <a href="#" class="text-[14px] font-normal leading-[110%] text-dark-gray">Home</a>
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="text-[14px] font-medium leading-[110%] font-display text-gray-black inline-block">Shop</span>
      </div>
      <h2 class="pt-[13.5px] text-2xl font-semibold text-gray-black font-display">Shop</h2>
    </div>
  </div>
  <!-- Breadcrumb End -->
  <!-- Sign In Form Start -->
  <div class="container py-20">
    <div class="flex flex-wrap lg:flex-nowrap items-start gap-6">
      <!-- cart billing start -->
      <div class="cart-total lg:w-2/3 w-full">
        <form role="form" action="{{ route('user.stripe.post') }}" method="post" class="require-validation"
          data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
          @csrf
          <div class="billing-info-wrapper">
            <div class="p-8">
              <h2 class="text-start text-2xl text-[#272343] font-semibold mb-6 font-display">Billing Information</h2>
              <div class="flex flex-col sm:flex-row gap-5 items-center mb-5">
                <div class="w-full">
                  <input type="text" name="b_name" value="{{ $UserData->name }}" placeholder="Name"
                    class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>

              </div>
              <div class="w-full inline-flex mb-5">
                <textarea name="b_address"
                  class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out"
                  placeholder="Address"   id="" cols="10" rows="5">{{ $UserData->address }}</textarea>
              </div>
              <div class="flex flex-col sm:flex-row gap-5 items-center mb-5">
                <div class="w-full">
                  <input type="text" name="b_phone" placeholder="Phone" value="{{ $UserData->phone}}"
                    class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>

                <div class="w-full">
                  <input type="email" name="b_email" placeholder="Email" value="{{ $UserData->email }}"
                    class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>
              </div>

              <!-- <div class="cursor-pointer">
                  <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="cursor-pointer test" type="checkbox" value="yes">
                  <label for="wp-comment-cookies-consent" >Ship to a different address</label>
              </div> -->

              <label class="cursor-pointer flex" for="chkFacility3">
                <input id="chkFacility3" name="shipping_status" class="cursor-pointer test" type="checkbox"
                  value="yes">
                <span class="select-none">Shipping Information</span>
              </label>

            </div>
            <hr class="my-0">

            <div class="changeme hidden p-8">
              <h2 class="text-start text-2xl text-[#272343] font-semibold mb-6 font-display">Shipping Information</h2>
              <div class="flex flex-col sm:flex-row gap-5 items-center mb-5">
                <div class="w-full">
                  <input type="text" name="s_name" placeholder="First Name"
                    class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>

              </div>
              <div class="w-full inline-flex mb-5">
                <textarea name="s_address"
                  class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out"
                  placeholder="Address"  id="" cols="10" rows="5"></textarea>
              </div>
              <div class="flex flex-col sm:flex-row gap-5 items-center">
                <div class="w-full">
                  <input type="text" name="s_phone" placeholder="Phone"
                    class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>

                <div class="w-full">
                  <input type="email" name="s_email" placeholder="Email"
                    class="input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                </div>
              </div>
            </div>
            <hr class="my-0">
            <div class="p-8">
              <h2 class="text-start text-2xl text-[#272343] font-semibold mb-6 font-display">Payment</h2>

              <div class="flex items-center mb-4 ">
                <input checked id="default-radio-1" type="radio" value="1" name="payment_type" class="w-4 h-4">
                <label for="default-radio-1"
                  class="ml-2 text-[18px] leading-[110%] font-normal text-gray-black cursor-pointer">Cash on
                  Delivery</label>
              </div>



              <hr>
              <div class="flex items-center gap-[27px] pb-6">
                <div class="flex items-center">
                  <input id="default-radio-2" type="radio" value="2" name="payment_type" class="w-4 h-4">
                  <label for="default-radio-2"
                    class="ml-2 text-[18px] leading-[110%] font-normal text-gray-black cursor-pointer">Stripe</label>
                </div>
              </div>
              <div id="cardInfo" class="hidden p-8">
                <h2 class="text-start text-2xl text-[#272343] font-semibold mb-6 font-display">Card Information</h2>
                <div class="flex flex-col sm:flex-row gap-5 items-center mb-5">
                  <div class="w-full">
                    <input type="text"  placeholder="Name on Card"
                      class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                  </div>
                  <div class="w-full">
                    <input type="text"  placeholder="Card Number"
                      class="card-number input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                  </div>

                </div>
                <div class="flex flex-col sm:flex-row gap-5 items-center">
                  <div class="w-full">
                    <input type="text"  placeholder="CVC / Ex: 311"
                      class="card-cvc input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                  </div>

                  <div class="w-full">
                    <input type="text" placeholder="Expiration Month / MM"
                      class="card-expiry-month input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                  </div>
                  <div class="w-full">
                    <input type="text"  placeholder="Expiration Year / YYYY"
                      class="card-expiry-year input-box focus:outline-none  focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                  </div>
                </div>
              </div>

            </div>
          </div>
          <button type="submit"
          class="w-full flex gap-3 items-center justify-center mt-5 bg-accents hover:bg-[#272343] rounded-lg py-[16px] text-[18px] font-bold font-display leading-[110%] text-gray-white  transition-all duration-300">Place
          Order <span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.5 7.5L20 12M20 12L15.5 16.5M20 12H4" stroke="white" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
        </button>
        </form>
      </div>
      <!-- cart billing end -->
      <!-- cart details start -->
      <div class="cart-total p-8 h-auto lg:w-1/3 w-full">
        <!-- cart item start  -->
        @foreach (Cart::instance('cart')->content() as $item)

        <div class="flex justify-between items-center pb-4">
          <div class="flex items-center gap-3">
            <div class="w-[50px] h-[50px]">
              @if($item->model && $item->model->thumbnail)
              <img src="{{ asset('product/thumbnail/'.$item->model->thumbnail) }}" alt=""
                class="w-full h-full object-cover">
              @endif

            </div>
            <div class="flex gap-[6px]">
              <p class="font-display2 text-[14px] leading-[100%] font-normal text-[#272343]">{{
                substr($item->model->name, 0, 20) }}</p>
              <span class="font-display2 text-[14px] leading-[100%] font-normal text-[#272343]">X</span>
              <p class="font-display2 text-[14px] leading-[100%] font-normal text-[#272343]">{{ $item->qty }}</p>
            </div>
          </div>
          <p class="text-gray-black text-[16px] leading-[120%] font-display font-medium">${{ $item->subtotal }}</p>
        </div>
        @endforeach
        <!-- cart item end -->

        <hr>
        <div class="subtotal-info">
          <div class="flex justify-between items-center">
            <p class="common-hedding">subtotal</p>
            <p class="text-gray-black text-[16px] leading-[120%] font-display font-medium">${{ Cart::subtotal()}}</p>
          </div>
          <div class="flex justify-between items-center pt-4">
            <p class="common-hedding">discount</p>
            <p class="text-gray-black text-[16px] leading-[120%] font-display font-medium">0%</p>
          </div>
          <div class="flex justify-between items-center pt-4">
            <p class="common-hedding">shipping </p>
            <p class="text-gray-black text-[16px] leading-[120%] font-display font-medium">Free</p>
          </div>
          <hr>
          <div class="flex justify-between items-center">
            <p class="common-hedding">Total:</p>
            <p class="text-gray-black text-[22px] leading-[120%] font-display font-semibold">
              ${{Cart::instance('cart')->total() }}</p>
          </div>

         
        </div>
      </div>
      <!-- cart details end -->
    </div>
  </div>
  <!-- Sign In Form End -->
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
{{-- <script type="text/javascript">
$(function() {
  var $form = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
    $inputs = $form.find('.required').find(inputSelector),
    $errorMessage = $form.find('div.error'),
    valid = true;
    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
      if (response.error) {
          $('.error')
              .removeClass('hide')
              .find('.alert')
              .text(response.error.message);
      } else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
      }
  }
});
</script> --}}
<script type="text/javascript">
  $(function () {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function (e) {
      var $form = $(".require-validation"),
        paymentMethod = $('input[name="payment_type"]:checked').val(),
        $inputs = $form.find('.required').find('input[type=email], input[type=password], input[type=text], input[type=file], textarea'),
        $errorMessage = $form.find('div.error'),
        valid = true;

      $errorMessage.addClass('hide');
      $('.has-error').removeClass('has-error');

      $inputs.each(function (i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });

      if (paymentMethod === '1') {
        return; // Allow default form submission for Cash on Delivery
      }

      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    });

    function stripeResponseHandler(status, response) {
      if (response.error) {
        if (response.error.param === 'number') {
          // Display an alert for card number error
          alert('Card number is invalid. Please check and try again.');
        } else {
          // Display a generic error alert
          $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
        }
      } else {
        /* token contains id, last4, and card type */
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
      }
    }
  });
</script>

<script>
  document.getElementById('chkFacility3').addEventListener('change', function() {
    var shippingInfo = document.querySelector('.changeme');
    if (this.checked) {
        shippingInfo.classList.remove('hidden');
    } else {
        shippingInfo.classList.add('hidden');
    }
});

</script>

<script>
  document.getElementById('default-radio-1').addEventListener('change', function() {
      document.getElementById('cardInfo').classList.add('hidden');
  });
  document.getElementById('default-radio-2').addEventListener('change', function() {
      document.getElementById('cardInfo').classList.remove('hidden');
  });
</script>