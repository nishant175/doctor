@extends('admin.layouts.app')

@section('content')

@push('head')
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
@endpush

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ (Route::currentRouteName() == 'treatment.create') ? 'ADD' : 'EDIT' }} treatment</h1>
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


                            <form role="form" action="{{ (Route::currentRouteName() == 'treatment.create') ? route('treatment.store') : route('treatment.update', ['treatment' => isset($treatment->id)])  }}" method="post">
                                @csrf

                                @if(Route::currentRouteName() == 'treatment.edit')
                                <input type="hidden" name="_method" value="PUT">
                                @endif
                                <input type="hidden" name="hospital_id" value="1">
                                <input type="hidden" name="doctor_id" value="1">
                                <div class="form-group">
                                    <label>Treatement Title</label>
                                    <input class="form-control" name="title" placeholder="Enter treatment title" value="{{ isset($treatment->title) ? $treatment->title : old('title') }}">
                                    @error('title')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <!--<div class="form-group">
                                    <label>Hospital</label>
                                    <select class="form-control" name="hospital_id">
                                    @forelse($hospitals as $hospital)
                                        <option @if( $hospital->id == old('hospital_id') || $hospital->id == @$treatment->hospital_id) selected  @endif value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                    </select>
                                    @error('hospital_id')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>-->
                                <!--<div class="form-group">
                                    <label>Doctor</label>
                                    <select class="form-control" name="doctor_id">
                                    @forelse($doctors as $doctor)
                                        <option @if( $doctor->id == old('doctor_id') || $doctor->id == @$treatment->doctor_id) selected  @endif value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                    </select>
                                    @error('doctor_id')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>-->
                            <div class="form-group">
                                <label>Introduction</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea class="form-control" id="" name="introduction">{{ (old('introduction') != null) ? old('introduction') : @$treatment->introduction }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Cost</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea class="form-control" id="myeditor1" name="cost">{{ (old('cost') != null) ? old('cost') : @$treatment->cost }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Specialization</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea class="form-control" id="myeditor2" name="cost">{{ (old('specialization') != null) ? old('specialization') : @$treatment->specialization }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Faqs</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea class="form-control" id="myeditor2" name="faqs">{{ (old('faqs') != null) ? old('faqs') : @$treatment->faqs }}</textarea>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            
                            
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