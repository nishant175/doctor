@extends('admin.layouts.app')

@section('content')

<form  method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Name/Description fields, irrelevant for this article --}}

    <div class="form-group">
        <label for="document">Documents</label>
        <div class="needsclick dropzone" id="document-dropzone">

        </div>
    </div>
</form>


<div class="well">
<div class="row">
<h4 class="text-center">Your previous uploaded Images</h4><hr>
  @forelse($images as $image)
    <div class="col-md-3" style="padding:15px">
      <img src="{{ asset($image->image) }}" class="img-thumbnail" width:75px; height:75px; object-fit:cover;>
    </div>
  @empty
    <h4 class="text-center">No Images Available.</h4>

  @endforelse
  </div>
</div>

@endsection

@section('script')

<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('image-upload.upload') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + file.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.name !== 'undefined') {
        name = file.name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      console.log(name);
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
</script>

@endsection