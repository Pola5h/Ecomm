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
        <div class="row row-cards">

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
                                    <th>Banner</th>
                                    <th>Small Title
                                    </th>
                                    <th>Big Title
                                    </th>
                                    <th>Discount</th>
                                    <th>status</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $Datas as $key => $data )
                                <tr>
                                    <td> {{ $key+1 }}</td>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ asset('hero/' . $data->banner) }}')"></span>

                                        </div>
                                    </td>
                                    <td>{{ $data->small_title }}</td>
                                    <td>{{ $data->big_title }}</td>
                                    <td>{{ $data->discount }} %</td>
                                    <td>
                                        <form action="{{ route('admin.update-hero-status', $data->id) }}" method="POST" id="heroForm">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $data->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                            
                                    

                                    <td>
                                        <div class="btn-list flex-nowrap">

                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">

                                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modal-team">
                                                        Discount </a>
                                                    <form action="{{ route('admin.hero.destroy', $data->id) }}" method="POST">
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
                        <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add a new team</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3 align-items-end">

                                            <div class="col">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add
                                            Team</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('#status').on('change', function () {
            if(this.checked) {
                this.value = 1;
            } else {
                this.value = 0;
            }
            $('#heroForm').submit();
        });
    });
</script>
@endsection