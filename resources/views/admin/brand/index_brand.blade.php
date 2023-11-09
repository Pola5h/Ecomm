@extends('admin.master')
@section('admin')

<div class="page-body">
  <div class="container-xl d-flex flex-column justify-content-center">

    <div class="row row-cards">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">brand List</h3>
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
                @foreach ($data as $key => $brands)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td data-label="Name">
                    <div class="d-flex py-1 align-items-center">
                      <span class="avatar me-2"
                        style="background-image: url('{{ $brands->image ? asset('brand/' . $brands->image) : asset('../backend/assets/static/logo.svg') }}')"></span>

                    </div>
                  </td>

                  <td class="text-muted" data-label="Role">
                    {{$brands->name}} </td>
                  <td>
                    <div class="btn-list flex-nowrap">

                      <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                          Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="{{ route('admin.brand.edit', $brands->slug) }}">
                            Edit
                          </a>
                          <form action="{{ route('admin.brand.destroy', $brands->slug) }}" method="POST">
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
      <div class="col-4">

        <?php
        if (!empty($editData)) {
            $btn = 'Update';
        } else {
            $btn = 'Add';
        }
        ?>
        @if (empty($editData))

        <form method="post" class="card" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h4 class="card-title">Add brand</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-8">
                <div class="row">
                  <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                      <div class="col-auto mb-3">
                        <img src="" width="200" class="img-icon" />
                      </div>

                      <div class="col-auto mb-3">
                        <label class="form-label required">Image</label>

                        <input type="file" class="form-control" name="image" required />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Required..." />
                    </div>
                    {{-- <div class="mb-3">
                      <label class="form-label required">Description</label>

                      <textarea name="description" class="form-control"
                        rows="5"></textarea>

                    </div> --}}

                  </div>

                </div>
              </div>

            </div>
          </div>
          <div class="card-footer text-end">
            <div class="d-flex">
              <button type="submit" class="btn btn-primary ms-auto">
                {{ $btn }} </button>
            </div>
          </div>
        </form>

        @else

        <form method="post" class="card" action="{{ route('admin.brand.update',$editData->slug) }}"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            <h4 class="card-title">Edit brand</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-8">
                <div class="row">
                  <div class="col-md-6 col-xl-12">

                    <div class="mb-3">
                      <div class="col-auto mb-3">
                        <img src="{{ asset('brand/' . $editData->image) }}" width="200" class="img-icon" />
                      </div>

                      <div class="col-auto mb-3">
                        <label class="form-label">Image</label>

                        <input type="file" class="form-control" name="image" />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label required">Name</label>
                      <input type="text" class="form-control"
                        value="{{ !empty($editData->name) ? $editData->name : '' }}" name="name"
                        placeholder="Required..." />
                    </div>
                    {{-- <div class="mb-3">
                      <label class="form-label required">Description</label>

                      <textarea class="form-control" name="description" rows="5">{{ !empty($editData->description) ? $editData->description : '' }}</textarea>

                    </div> --}}



                  </div>

                </div>
              </div>

            </div>
          </div>
          <div class="card-footer text-end">
            <div class="d-flex">
              <button type="submit" class="btn btn-primary ms-auto">
                {{ $btn }}
              </button>
            </div>
          </div>
        </form>

        @endif

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
@endsection