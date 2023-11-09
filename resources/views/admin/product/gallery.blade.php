@extends('admin.master')
@section('admin')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@php
$pid =1;
@endphp
<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">

            <div class="col-md-6 col-xl-9">

                <div class="mb-3">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Multiple File Upload</h3>
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

            </div>
        </div>
    </div>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>


<script>
    console.log('Adding Dropzone options...');
    
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
      url: "{{ route('admin.gallery.upload') }}",
      maxFilesize: 2, // MB
      addRemoveLinks: true,
      autoProcessQueue: false, // Don't process the files immediately
      headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
  
      success: function (file, response) {
       $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
       uploadedDocumentMap[file.name] = response.name
      },
      removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
        name = file.file_name
       } else {
        name = uploadedDocumentMap[file.name]
       }
       $('form').find('input[name="document[]"][value="' + name + '"]').remove()
      },
      init: function () {
       @if(isset($project) && $project->document)
        var files =
         {!! json_encode($project->document) !!}
        for (var i in files) {
         var file = files[i]
         this.options.addedfile.call(this, file)
         file.previewElement.classList.add('dz-complete')
         $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
       @endif
      }
    }
    
    // Get the submit button
    var submitButton = document.querySelector("button[type='submit']");
    
    // Process the queue when the submit button is clicked
    submitButton.addEventListener("click", function() {
      // Make sure Dropzone is defined
      if (Dropzone.instances.length > 0) {
        var myDropzone = Dropzone.instances[0]; // Get the instance
        myDropzone.processQueue(); // Process the queue
      }
    });
</script>

@endsection