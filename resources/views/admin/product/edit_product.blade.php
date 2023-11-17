@extends('admin.master')
@section('admin')

<div class="page-body">
    <div class="container-xl d-flex flex-column justify-content-center">

        <div class="row row-cards">

            <div class="col-12">

                <form method="post" class="card" action="{{ route('admin.product.update',$data->slug) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Thumbnail</h3>
                                <input type="file" class="dropify form-control" name="thumbnail"
                                    data-default-file="{{ asset('product/thumbnail/' . $data->thumbnail) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Name
                                </div>
                                <input type="text" class="form-control" name="name"
                                    value="{{ !empty($data->name) ? $data->name : '' }}" placeholder="Required..." />
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Price
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> $ </span>
                                    <input type="number" name="price"
                                        value="{{ !empty($data->price) ? number_format($data->price, 0, '.', '') : '' }}"
                                        class="form-control" placeholder="Enter price" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Discount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> % </span>
                                    <input type="number" name="discount"
                                        value="{{ !empty($data->discount) ? number_format($data->discount, 0, '.', '') : '' }}"
                                        class="form-control" placeholder="Enter discount" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label required">
                                    Stock Amount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> ? </span>
                                    <input type="number" name="stock_quantity"
                                        value="{{ !empty($data->stock_quantity) ? $data->stock_quantity : '' }}"
                                        class="form-control" placeholder="Enter stock amount" autocomplete="off">
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
                                    @if($data->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
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
                                    @if($data->brand_id == $brand->id)
                                    <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                    @else
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endif
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
                                        <input class="form-check-input" type="radio" name="status" value="1" @if($data->status == 1) checked @endif>
                                        <span class="form-check-label">Active</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="0" @if($data->status == 0) checked @endif>
                                        <span class="form-check-label">Deactive</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="form-label">Feature</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" value=1 @if($data->featured == 1) checked @endif />
                                        <span class="form-check-label">Yes</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" value=0  @if($data->featured == 0) checked @endif />
                                        <span class="form-check-label">No</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card card-body">
                            <label class="form-label required">Short Description</label>
                            <textarea id="tinymce-mytextarea" name="short_description">{{ !empty($data->short_description) ? $data->short_description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card card-body">
                            <label class="form-label required">Long Description</label>
                            <textarea id="tinymce-mytextarea2" name="description">{{ !empty($data->description) ? $data->description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer  text-center">
                        <div class="d-flex" style="justify-content: center;">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection