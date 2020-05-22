@extends('admin.layouts.app')

@section('content')

@push('head')
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
@endpush

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ (Route::currentRouteName() == 'testimonial.create') ? 'ADD' : 'EDIT' }} testimonial</h1>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" action="{{ (Route::currentRouteName() == 'testimonial.create') ? route('testimonial.store') : route('testimonial.update', ['testimonial' => $testimonial->id])  }}" method="post" enctype="multipart/form-data">
                                @csrf

                                @if(Route::currentRouteName() == 'testimonial.edit')
                                <input type="hidden" name="_method" value="PUT">
                                @endif
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name="title" placeholder="Enter testimonial title" value="{{ isset($testimonial->title) ? $testimonial->title : old('title') }}">
                                    @error('title')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Place</label>
                                    <input class="form-control" name="place" placeholder="Enter The place" value="{{ isset($testimonial->place) ? $testimonial->place : old('place') }}">
                                    @error('place')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" id="myeditor" rows="3">{{ (old('description') != null) ? old('description') : @$testimonial->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image"  value="{{ isset($testimonial->image) ? $testimonial->image : old('image') }}">
                                    @error('image')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                @if(isset($testimonial->image))
                                <div style="width:110px;border:1px solid lightgrey; border-radius: 2px; padding:5px">
                                    <img  width="100px" src="{{ url('images/'.$testimonial->image) }}">
                                </div><br>
                                @endif
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
@endpush

@endsection