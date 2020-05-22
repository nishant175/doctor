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
                                <div class="form-group">
                                    <label>Treatement Title</label>
                                    <input class="form-control" name="title" placeholder="Enter treatment title" value="{{ isset($treatment->title) ? $treatment->title : old('title') }}">
                                    @error('title')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
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
                                </div>
                                <div class="form-group">
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
                                </div>
                            <div class="form-group">
                                <label>Description</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea name="description" class="form-control" id="myeditor1" name="description">{{ (old('description') != null) ? old('description') : @$treatment->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Patient Name</label>
                                <input class="form-control" name="patient_name" placeholder="Enter treatment patient_name" value="{{ isset($treatment->patient_name) ? $treatment->patient_name : old('patient_name') }}">
                                @error('patient_name')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Patient Age</label>
                                <input class="form-control" name="patient_age" placeholder="Enter treatment patient_age" value="{{ isset($treatment->patient_age) ? $treatment->patient_age : old('patient_age') }}">
                                @error('patient_age')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Patient Mobile</label>
                                <input class="form-control" name="patient_mobile" placeholder="Enter treatment patient_mobile" value="{{ isset($treatment->patient_mobile) ? $treatment->patient_mobile : old('patient_mobile') }}">
                                @error('patient_mobile')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label>Patient City</label>
                                <input class="form-control" name="patient_city" placeholder="Enter treatment patient_city" value="{{ isset($treatment->patient_city) ? $treatment->patient_city : old('patient_city') }}">
                                @error('patient_city')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Patient State</label>
                                <input class="form-control" name="patient_state" placeholder="Enter treatment patient_state" value="{{ isset($treatment->patient_state) ? $treatment->patient_state : old('patient_state') }}">
                                @error('patient_state')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Patient Pincode</label>
                                <input class="form-control" name="patient_pincode" placeholder="Enter treatment patient_pincode" value="{{ isset($treatment->patient_pincode) ? $treatment->patient_pincode : old('patient_pincode') }}">
                                @error('patient_pincode')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Patient Address</label>
                                <textarea name="patient_address" class="form-control" id="myeditor3" rows="3">{{ (old('patient_address') != null) ? old('patient_address') : @$treatment->patient_address }}</textarea>
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