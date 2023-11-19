@extends('admin.master')
@section('admin')
<div class="page-body">
    <div class="container-xl">

   
        <div class="row row-cards">
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product List</h3>
                </div>
                <div class="table-responsive">
                  <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                      <tr>
                        <th>SL#</th>
                        <th>Image</th>
                        <th>Name</th>
      
                        <th class="w-1"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $product)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td data-label="Name">
                          <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2"
                              style="background-image: url('{{ $product->thumbnail ? asset('product/thumbnail/' .  $product->thumbnail) : asset('../backend/assets/static/logo.svg') }}')"></span>
      
                          </div>
                        </td>
      
                        <td class="text-muted" data-label="Role">
                          {{$product->name}} </td>
                        <td>
                          <div class="btn-list flex-nowrap">
      
                            <div class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                              </button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.product.edit', $product->slug) }}">
                                  Edit
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.gallery', $product->id) }}">
                                    View Gallery
                                  </a>
                                <form action="{{ route('admin.product.destroy', $product->slug) }}" method="POST">
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
          
          </div>
    </div>

</div>



@endsection