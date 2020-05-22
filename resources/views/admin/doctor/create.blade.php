@extends('admin.layouts.app')

@section('content')

@push('head')
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
@endpush

@php
    
    $qualification = isset($doctor->qualification) ? explode(',', $doctor->qualification) : [];
    $qualification = (old('qualification') != null) ? old('qualification') : $qualification;


    $speciality = isset($doctor->speciality) ? explode(',', $doctor->speciality) : [];
    $speciality = (old('speciality') != null) ? old('speciality') : $speciality;
@endphp

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ (Route::currentRouteName() == 'doctor.create') ? 'ADD' : 'EDIT' }} DOCTOR</h1>
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
                            <form role="form" action="{{ (Route::currentRouteName() == 'doctor.create') ? route('doctor.store') : route('doctor.update', ['doctor' => $doctor->id])  }}" method="post">
                                @csrf

                                @if(Route::currentRouteName() == 'doctor.edit')
                                <input type="hidden" name="_method" value="PUT">
                                @endif
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter Doctor Name" value="{{ isset($doctor->name) ? $doctor->name : old('name') }}">
                                    @error('name')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter The Slug" value="{{ isset($doctor->slug) ? $doctor->slug : old('slug') }}">
                                    <p class="help-block">Example: random-doctor</p>
                                    @error('slug')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input class="form-control" name="designation" placeholder="Designation" value="{{ isset($doctor->designation) ? $doctor->designation : old('designation') }}">
                                    @error('designation')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Experience</label>
                                    <input class="form-control" name="experience" placeholder="Experience" value="{{ isset($doctor->experience) ? $doctor->experience : old('experience') }}">
                                    @error('experience')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Qualification&nbsp;</label>
                                    <label class="checkbox-inline">
                                        <input @if(in_array('MBBS', $qualification)) checked @endif type="checkbox" name="qualification[]" value="MBBS">MBBS
                                    </label>
                                    <label class="checkbox-inline">
                                        <input @if(in_array('MS', $qualification)) checked @endif type="checkbox" name="qualification[]" value="MS">MS
                                    </label>
                                    <label class="checkbox-inline">
                                        <input @if(in_array('MD', $qualification)) checked @endif type="checkbox" name="qualification[]" value="MD">MD
                                    </label>
                                    <label class="checkbox-inline">
                                        <input @if(in_array('MCH', $qualification)) checked @endif type="checkbox" name="qualification[]" value="MCH">MCH
                                    </label>
                                    @error('qualification')
                                        <br><label class="error">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Speciality</label>
                                    <select name="speciality[]" multiple class="form-control">
                                        <option @if(in_array('Intracranial Tumor', $speciality)) selected @endif>Intracranial Tumor</option>
                                        <option @if(in_array('Deep Brain Stimulation', $speciality)) selected @endif>Deep Brain Stimulation</option>
                                        <option @if(in_array('Spinal', $speciality)) selected @endif>Spinal</option>
                                        <option @if(in_array('Gamma Knife Radio', $speciality)) selected @endif>Gamma Knife Radio</option>
                                        <option @if(in_array('Parkinson Disease', $speciality)) selected @endif>Parkinson Disease</option>
                                        <option @if(in_array('Epilepsy', $speciality)) selected @endif>Epilepsy</option>
                                        <option @if(in_array('Obsessive Compulsive Disorder', $speciality)) selected @endif>Obsessive Compulsive Disorder</option>
                                        <option @if(in_array('Brachial Plexus Injuries', $speciality)) selected @endif>Brachial Plexus Injuries</option>
                                    </select>
                                    @error('speciality')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select name="category_id" class="form-control">
                                    @forelse($categories as $category)
                                        <option @if( $category->id == old('category_id') || $category->id == @$doctor->category_id) selected  @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty

                                    @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hospital</label>
                                    <select name="hospital_id" class="form-control">
                                    @forelse($hospitals as $hospital)
                                        <option @if( $hospital->id == old('hospital_id') || $hospital->id == @$doctor->hospital_id) selected  @endif value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @empty

                                    @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>About Doctor</label>
                                <textarea name="about" class="form-control" id="myeditor" rows="3">{{ (old('about') != null) ? old('about') : @$doctor->about }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Specializations</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea name="specialization" class="form-control" id="myeditor1" name="specialization">{{ (old('specialization') != null) ? old('specialization') : @$doctor->specialization }}</textarea>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>List Of Awards</label>
                                <textarea name="list_of_awards" id="myeditor2" class="form-control" rows="3">{{ (old('list_of_awards') != null) ? old('list_of_awards') : @$doctor->list_of_awards }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Work Experience</label>
                                <textarea name="work_experience" class="form-control" id="myeditor3" rows="3">{{ (old('work_experience') != null) ? old('work_experience') : @$doctor->work_experience }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Education & Training</label>
                                <textarea name="education_training" class="form-control" id="myeditor4" rows="3">{{ (old('education_training') != null) ? old('education_training') : @$doctor->education_training }}</textarea>
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