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
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" action="{{ (Route::currentRouteName() == 'hospital.create') ? route('hospital.store') : route('hospital.update', ['hospital' => isset($hospital->id)])  }}" method="post">
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
                                <!-- <div class="form-group">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter The Slug" value="{{ isset($hospital->slug) ? $hospital->slug : old('slug') }}">
                                    <p class="help-block">Example: random-hospital</p>
                                    @error('slug')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div> -->
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
                                <label>Address</label>
                                <textarea name="address" class="form-control" id="myeditor3" rows="3">{{ (old('address') != null) ? old('address') : @$hospital->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Facilities</label>
                                <textarea name="facilities" class="form-control" id="myeditor4" rows="3">{{ (old('facilities') != null) ? old('facilities') : @$hospital->facilities }}</textarea>
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
@endpush

@endsection