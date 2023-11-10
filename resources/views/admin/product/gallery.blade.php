@extends('admin.master')
@section('admin')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">

            <div class="col-md-6 col-xl-9">

                <div class="mb-3">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Upload Your Image</h3>
                            <form action="{{ route('admin.gallery.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="needsclick dropzone" id="document-dropzone">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-5 ">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                @if(count($galleryData) === 0)
                <div class="card">
                    <div class="card-body">
                    <div class="card-header mb-">
                        <h3 class="card-title">Category List</h3>
                    </div>
                    <h3 style="text-align: center; color: red;">No Image to show</h3>

                    </div>
                 
                </div>
           
                @else
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Image List</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Image</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($galleryData as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url('{{ $data->image ? asset('product/gallery/' . $data->image) : asset('../backend/assets/static/logo.svg') }}')"></span>

                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ route('admin.gallery.delete', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
           
                @endif



            </div>
        </div>
    </div>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>


<script>
    console.log('Adding Dropzone options...');

    var uploadedDocumentMap = {};
    Dropzone.options.documentDropzone = {
      url: "{{ route('admin.gallery.upload', ['product' => $productId]) }}",
      maxFilesize: 2,
      addRemoveLinks: true,
      autoProcessQueue: false,
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
      success: function (file, response) {
        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
        uploadedDocumentMap[file.name] = response.name;
      },
      removedfile: function (file) {
        file.previewElement.remove();
        var name = uploadedDocumentMap[file.name] !== undefined ? uploadedDocumentMap[file.name] : file.file_name;
        $('form').find('input[name="document[]"][value="' + name + '"]').remove();
      },
      init: function () {
        @if(isset($project) && $project->document)
          var files = {!! json_encode($project->document) !!};
          for (var i in files) {
            var file = files[i];
            this.options.addedfile.call(this, file);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
          }
        @endif
      }
    }
    
    var submitButton = document.querySelector("button[type='submit']");
    submitButton.addEventListener("click", function() {
      if (Dropzone.instances.length > 0) {
        var myDropzone = Dropzone.instances[0];
        myDropzone.processQueue();
      }
    });
</script>
@endsection