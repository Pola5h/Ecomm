@extends('admin.master')
@section('admin')
<div class="page-body">
    <div class="container-xl">

        <div class="mb-3 row row-cards">

            <div class="col-md-6 col-xl-12">

                <form method="post" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Banner Image</h3>
                                <input type="file" name="banner" class="dropify" data-height="300" />
                            </div>
                        </div>
                    </div>



                    <div class="mb-3 card card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Small Title
                                </div>
                                <textarea rows="5" name="small_title" class="form-control"
                                    placeholder="Here can be your description"></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Big Title </div>
                                <textarea rows="5" name="big_title" class="form-control"
                                    placeholder="Here can be your description"></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-label required">
                                    Discount
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"> % </span>
                                    <input type="number" name="discount" class="form-control"
                                        placeholder="Enter discount" autocomplete="off">
                                </div>
                            </div>

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
        {{-- <div class="row row-cards">

            <div class="col-md-6 col-xl-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category List</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $categories)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ $categories->icon ? asset('category/' . $categories->icon) : asset('../backend/assets/static/logo.svg') }}')"></span>

                                        </div>
                                    </td>

                                    <td class="text-muted" data-label="Role">
                                        {{$categories->name}} </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">

                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.category.edit', $categories->slug) }}">
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.category.destroy', $categories->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div> --}}
    </div>

</div>

@endsection