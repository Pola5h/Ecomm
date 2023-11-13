     <!-- Account Setting Start -->
     <div id="account_settings">
        <div class="container px-3 md:px-5 xl:px-0 py-10">
            <div class="accout-setting flex flex-col xl:flex-row gap-6">
                <!-- account inforamation start -->
                @livewire('frontend.account-setting-component')

                <!-- account inforamation end -->

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- user password change start -->
                    @livewire('frontend.user-password-component')

                    <!-- user password change end -->

                    <!-- user profile change start -->
                    @livewire('frontend.profile-image-component')

                    <!-- user profile change end -->
                </div>

            </div>
        </div>
    </div>
    <!-- Account Setting End -->
