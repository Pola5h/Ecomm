@extends('admin.master')
@section('admin')

<div class="page-body">
    <div class="container-xl d-flex flex-column justify-content-center">


        <div class="col-md-12" style="display: flex; justify-content: center; align-items: center;">
            <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf


                <div class="col-md-6 col-xl-8">
                    <div class="mb-3 ">
                        <div class="card card-body">
                            <div class="col-auto mb-3">
                                <img src="{ isset($image) ? URL::asset('../backend/assets/uploads/' . $image) : URL::asset('../backend/assets/static/logo.svg') }"
                                    width="200" class="img-icon" />
                            </div>
                            <div class="col-auto mb-3">
                                <label class="form-label required">Thumbnil</label>
                                <input type="file" class="form-control" name="image" required />
                            </div>
                            
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card card-body">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Required..." />
                        </div>
                    </div>
                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-label required">
                                    Category
                                </div>
                                <select name="category" class="form-select" id="select-states" required>
                                    <option value="" disabled selected> Select Category </option>
                                    @foreach(\App\Models\Category::get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-label required">
                                    Brand
                                </div>
                                <select name="brand" class="form-select" id="select-statesx" required>
                                    <option value="" disabled selected> Select Brand </option>
                                    @foreach(\App\Models\Brand::get() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Price
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> $ </span>
                                    <input type="text" class="form-control" placeholder="Enter price"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Discount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> % </span>
                                    <input type="text" class="form-control" placeholder="Enter discount"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Stock Amount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> ? </span>
                                    <input type="text" class="form-control" placeholder="Enter stock amount"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-label">Feature</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="feature" value="yes"
                                            checked />
                                        <span class="form-check-label">Yes</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="feature" value="no" />
                                        <span class="form-check-label">No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-label">Status</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="active"
                                            checked />
                                        <span class="form-check-label">Active</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="deactive" />
                                        <span class="form-check-label">Deactive</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="mb-3">
                        <div class="card card-body">

                            <label class="form-label required">Short
                                Description</label>

                                <textarea id="tinymce-mytextarea"></textarea>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="card card-body">

                            <label class="form-label required">Long Description</label>

                            <textarea id="tinymce-mytextarea2"></textarea>

                        </div>
                    </div>




                    <div class="col-auto mb-3">
                        <div class="card card-body">

                            <label class="form-label required">Gallery</label>
                            <input type="file" class="form-control" name="product_gallery[]" id="gallery-upload"
                                multiple required />
                        </div>
                    </div>

                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="image-preview">
                            <!-- Images will be inserted here -->
                        </div>
                        <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>

                </div>





                <div class="card-footer  text-center">
                    <div class="d-flex" style="justify-content: center;">
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>



</div>
</div>
<script>
    const fileInput = document.querySelector('input[type="file"]');
    const imgPreview = document.querySelector('.col-auto img');

    // Get the existing image source, if any.
    const existingImageSrc = imgPreview.getAttribute('src');

    // Listen for the change event on the file input field.
    fileInput.addEventListener('change', function() {
        // If the user has selected an image, preview it.
        if (fileInput.files.length > 0) {
            const fileReader = new FileReader();
            fileReader.onload = function() {
                imgPreview.src = fileReader.result;
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        } else {
            // If the user has not selected an image, show the existing image or the default image.
            imgPreview.src = existingImageSrc || '{{ URL::asset('../backend/assets/static/logo.svg') }}';
        }
    });
</script>

{{-- gallery script --}}


<script>
    document.querySelector('#gallery-upload').addEventListener('change', function() {
        var preview = document.querySelector('#image-preview');
        preview.innerHTML = ''; // Clear the preview
        Array.from(this.files).forEach(function(file, index) {
            var div = document.createElement('div');
            div.className = 'carousel-item' + (index === 0 ? ' active' : '');
            var img = document.createElement('img');
            img.className = 'd-block w-100';
            img.alt = '';
            img.src = URL.createObjectURL(file);
            img.onload = function() {
                URL.revokeObjectURL(img.src); // Free memory
            }
            div.appendChild(img);
            preview.appendChild(div);
        });
    });
</script>
{{-- ck script --}}



@endsection