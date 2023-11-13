<div class="box xl:w-[536px]">
    <div class="w-full ">
      
        <div class="p-6">
            @if(Session::has ('success_message'))

            <div class="alert alert-success">
                <strong>Success | {{Session::get('success_message')}}</strong>
            </div>
            @endif
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('POST')
            
                <h2 class="text-start xl:text-2xl acc-title text-[22px] text-[#272343] font-medium mb-6 font-display">
                    Account Information</h2>

                    <div class="w-full  mb-5">
                        <input type="text" name="name" placeholder="Input name" value="{{ old('name', $user->name ?? '') }}"
                               class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                    </div>
                <div class="flex flex-col sm:flex-row gap-5 items-center mb-5">

                    <div class="w-full">
                        <input type="email" name="email" placeholder="Input email" value="{{ old('email', $user->email ?? '') }}"
                               class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                    </div>
                    <div class="w-full">
                        <input type="text" name="phone" placeholder="Input phone number" value="{{ old('phone', $user->phone ?? '') }}"
                               class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">
                    </div>
                </div>

                    <div class="w-full mb-5">
                        <textarea name="address" placeholder="Input Your address" class="input-box focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out">{{ old('address', $user->address ?? '') }}</textarea>
                    </div>
                    

                  
                
                <button type="submit" class="btn-primary">Save Changes</button>
            </form>
            



        </div>
    </div>
</div>