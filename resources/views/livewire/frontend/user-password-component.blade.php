<div class="box xl:w-[424px]">
    <div class="">
        <div class="p-6">
            <h2 class="text-start xl:text-2xl acc-title text-[22px] text-[#272343] font-medium mb-6 font-display">
                Change Password
            </h2>


            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="relative">
                    <input type="password" placeholder="Current password"
                        class="form_password focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out"
                        id="CurrentPasswordInput" name="current_password" required>
                    <span class="absolute top-[17px] right-5 cursor-pointer">
                        <!-- Your eye icons go here -->
                    </span>
                </div>

                <div class="relative">
                    <input type="password" placeholder="New password"
                        class="form_password focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out"
                        id="CreatePasswordInput" name="password" required>
                    <span class="absolute top-[17px] right-5 cursor-pointer select-none">
                        <!-- Your eye icons go here -->
                    </span>
                </div>

                <div class="relative">
                    <input type="password" placeholder="Confirm password"
                        class="form_password focus:outline-none focus:ring-2 focus:ring-accents font-display transition duration-300 ease-in-out"
                        id="myInput" name="password_confirmation" required>
                    <span class="absolute top-[17px] right-5 cursor-pointer">
                        <!-- Your eye icons go here -->
                    </span>
                </div>

                <button type="submit" class="btn-primary">Update Password</button>
            </form>

        </div>

    </div>
</div>