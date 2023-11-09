@extends('admin.master')
@section('admin')
<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">

            <div class="col-md-6 col-xl-9">

                <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Thumbnail</h3>
                                <input type="file" name="thumbnail" class="dropify" data-height="300"  />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Name
                                </div>
                                <input type="text" class="form-control" name="name" placeholder="Required..." />
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Price
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> $ </span>
                                    <input type="number" name="price" class="form-control" placeholder="Enter price"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Discount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> % </span>
                                    <input type="number" name="discount" class="form-control"
                                        placeholder="Enter discount" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Stock Amount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> ? </span>
                                    <input type="number" name="stock_quantity" class="form-control"
                                        placeholder="Enter stock amount" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-label required">
                                    Category
                                </div>
                                <select name="category_id" class="form-select" id="select-states" required>
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
                                <select name="brand_id" class="form-select" id="select-statesx" required>
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

                            <div class="col-md-6 mb-3">
                                <div class="form-label">Status</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value=1 checked />
                                        <span class="form-check-label">Active</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value=0 />
                                        <span class="form-check-label">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-label">Feature</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" value=1 checked />
                                        <span class="form-check-label">Yes</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" value=0 />
                                        <span class="form-check-label">No</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card card-body">
                            <label class="form-label required">Short Description</label>
                            <textarea id="tinymce-mytextarea" name="short_description"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card card-body">
                            <label class="form-label required">Long Description</label>
                            <textarea id="tinymce-mytextarea2" name="description"></textarea>
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
            {{-- <div class="col-md-6 col-xl-3">
                <div class="card">

                    <div class="card-body">
                        <h3 class="card-title">Product Information</h3>

                        <ul class="steps steps-counter steps-vertical">
                            <li class="step-item">Thumbnil</li>
                            <li class="step-item">Basic Information</li>
                            <li class="step-item">gallery Images</li>

                        </ul>
                    </div>
                </div>

            </div> --}}

        </div>
    </div>

</div>



@endsection