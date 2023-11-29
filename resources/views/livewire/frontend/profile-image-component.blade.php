<div class="box xl:w-[312px]">
    <div class="">
        <div class="p-6">
            <h2 class="xl:text-2xl acc-title text-[22px]  text-[#272343] font-medium mb-6 font-display text-center">
                Change Profile Photo</h2>
            <form id="upload-form" method="POST" action="{{ route('user.updateProfilePhoto') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="pb-[26px] mx-auto">
                    <img class="w-[150px] h-[150px] rounded-full mx-auto object-cover"
                        src="{{ asset(Auth::user()->image ? 'images/'.Auth::user()->image : 'frontend/assets/images/all-img/profile-photo.png') }}"
                        alt="image description" id="blah">
                </div>
                <div class="flex justify-center pb-3">
                    <input type="file" name="real-file" id="real-file" hidden="hidden" onchange="readURL(this);"
                        accept=".jpeg, .doc, .docx, .xls, .xlsx, .txt, .jpg, .png, .gif" />
                    <button type="button" id="custom-button"
                        class="flex gap-3 items-center transition-all duration-300 hover:bg-[#272343] bg-accents text-white text-base font-semibold py-[17px] px-6 rounded-lg font-display">
                        <span class="">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 17H17.5C19.9853 17 22 14.9853 22 12.5C22 10.0147 19.9853 8 17.5 8H17.293C16.64 5.6915 14.5176 4 12 4C9.48245 4 7.35996 5.6915 6.70703 8H6.5C4.01472 8 2 10.0147 2 12.5C2 14.9853 4.01472 17 6.5 17H8"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M12 19.5V9.5M12 9.5L8.5 13M12 9.5L15.5 13" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>Upload Now</button>
                </div>
            </form>
            <p class="text-center text-[#636270] text-sm font-display">JPG or PNG. max size
                of 500KB</p>
        </div>
    </div>
</div>
<script>
    document.getElementById('real-file').addEventListener('change', function() {
        document.getElementById('upload-form').submit();
    });
</script>