@extends('admin.layouts.app')

@section('content')

@push('head')
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

@endpush

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ (Route::currentRouteName() == 'hospital.create') ? 'ADD' : 'EDIT' }} HOSPITAL</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    * Please fill all the required details.
                </div>
                <div class="panel-body">
                <form role="form" action="{{ (Route::currentRouteName() == 'hospital.create') ? route('hospital.store') : route('hospital.update', ['hospital' => isset($hospital->id)])  }}" method="post">
                    <div class="row">
                    
                        <div class="col-lg-6">
                            
                                @csrf

                                @if(Route::currentRouteName() == 'hospital.edit')
                                <input type="hidden" name="_method" value="PUT">
                                @endif
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter hospital Name" value="{{ isset($hospital->name) ? $hospital->name : old('name') }}">
                                    @error('name')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter The Slug" value="{{ isset($hospital->slug) ? $hospital->slug : old('slug') }}">
                                    <p class="help-block">Example: random-hospital</p>
                                    @error('slug')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" id="myeditor" rows="3">{{ (old('description') != null) ? old('description') : @$hospital->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Team specialities</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea name="team_specialities" class="form-control" id="myeditor1" name="team_specialities">{{ (old('team_specialities') != null) ? old('team_specialities') : @$hospital->team_specialities }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Infrastructure</label>
                                <textarea name="infrastructure" id="myeditor2" class="form-control" rows="3">{{ (old('infrastructure') != null) ? old('infrastructure') : @$hospital->infrastructure }}</textarea>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            

                        <div class="form-group">
                                <label>States</label>
                                <select required id="state" class="form-control" name="state">
                                <option value="">-- Please select --</option>
                                @foreach($states as $state)
                                    <option @if($state->id == @$hospital->state || old('state') == $state->id) selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                                </select>
                                </div>

                                <div class="form-group">
                                <label>Cities</label>
                                <div id="cities">
                                <select required  class="form-control" name="city">
                                <option value="">-- Please select --</option>
                                @forelse($cities as $city)
                                    <option @if($city->id == @$hospital->city || old('city') == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                @empty

                                @endforelse  
                                </select>
                                </div>
                                </div>    

                                <div class="form-group">
                                <label>Zip Code</label>
                                <input name="zip_code" class="form-control" value="{{ (old('zip_code') != null) ? old('zip_code') : @$hospital->zip_code }}">
                                </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" id="" rows="3">{{ (old('address') != null) ? old('address') : @$hospital->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Facilities</label>
                                <textarea name="facilities" class="form-control" id="myeditor4" rows="3">{{ (old('facilities') != null) ? old('facilities') : @$hospital->facilities }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Featured Image </label><br>
                                <button type="button" id="image-upload" class="btn btn-info" data-toggle="modal" data-target="#myModal">Upload / Replace Image</button>
                                <input id="hidden-image-featured" type="hidden" name="featured_image">
                                <div id="hidden-featured" style="padding:25px">
                                @if(@$hospital->featured_image !="")
                                    <img class="img-thumbnail" style="width:150px" src="{{ asset(@$hospital->featured_image) }}">
                                @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Inner Image </label><br>
                                <button type="button" id="image-upload1" class="btn btn-info" data-toggle="modal" data-target="#myModal">Upload / Replace Image</button>
                                <input id="hidden-image-inner" type="hidden" name="image">
                                <div id="hidden-inner" style="padding:25px">
                                @if(@$hospital->image!="")
                                <img class="img-thumbnail" style="width:150px" src="{{ asset(@$hospital->image) }}">
                                @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-warning">Submit</button>
                            <button type="reset" class="btn btn-default">Reset Button</button>
                        </div>
                    </form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
<!-- /.row -->

@push('foot')
    <!-- creating a CKEditor instance called myeditor -->
    <script type="text/javascript">
        CKEDITOR.replace('myeditor');
        CKEDITOR.replace('myeditor1');
        CKEDITOR.replace('myeditor2');
        CKEDITOR.replace('myeditor3');
        CKEDITOR.replace('myeditor4');
    </script>

    <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Please Select An Image To Upload</h4>
        </div>
        <input type="hidden" id="image_type" value="">
        <div class="modal-body" id="image-content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="close-model" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script>

$('#image-upload').on('click', function(){
    $('#image_type').val('featured');
    $.ajax({
        type: "get",
        url: "{{ route('image-upload.all') }}",
        data: '',
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(data){
            $("#image-content").html(data);
        }
    });  
});

$('#image-upload1').on('click', function(){
    $('#image_type').val('inner');
    $.ajax({
        type: "get",
        url: "{{ route('image-upload.all') }}",
        data: '',
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(data){
            $("#image-content").html(data);
        }
    });  
});

$('#state').on('change', function(){
    var datastring = $(this).val();
    $.ajax({
        url: "{{ route('city-list') }}",
        type: "post",
        data: {stateId: datastring},
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(data){
            $("#cities").html(data);
        }
    });
});

</script>

@endpush

@endsection