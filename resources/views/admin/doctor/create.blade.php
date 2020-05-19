@extends('admin.layouts.app')

@section('content')

@push('head')
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
@endpush

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">ADD DOCTOR</h1>
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
                            <form role="form" action="{{ route('doctor.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" placeholder="Enter Doctor Name" value="{{ old('name') }}">
                                    @error('name')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter The Slug" value="{{ old('slug') }}">
                                    <p class="help-block">Example: random-doctor</p>
                                    @error('slug')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input class="form-control" name="designation" placeholder="Designation" value="{{ old('designation') }}">
                                    @error('designation')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Experience</label>
                                    <input class="form-control" name="experience" placeholder="Experience" value="{{ old('experience') }}">
                                    @error('experience')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Qualification&nbsp;</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="qualification[]" value="MBBS">MBBS
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="qualification[]" value="MS">MS
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="qualification[]" value="MD">MD
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="qualification[]" value="MCH">MCH
                                    </label>
                                    @error('qualification')
                                        <br><label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Speciality</label>
                                    <select name="speciality[]" multiple class="form-control">
                                        <option >Intracranial Tumor</option>
                                        <option >Deep Brain Stimulation</option>
                                        <option >Spinal</option>
                                        <option >Gamma Knife Radio</option>
                                        <option >Parkinson Disease</option>
                                        <option >Epilepsy</option>
                                        <option >Obsessive Compulsive Disorder</option>
                                        <option >Brachial Plexus Injuries</option>
                                    </select>
                                    @error('speciality')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select name="category" class="form-control">
                                        <option >Neurology and Neurosurgery</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hospital</label>
                                    <select name="hospital_id" class="form-control">
                                    @forelse($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @empty

                                    @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>About Doctor</label>
                                <textarea name="about" class="form-control" id="myeditor" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Specializations</label>
                                <!-- creating a text area for my editor in the form -->
                                <textarea name="specialization" class="form-control" id="myeditor1" name="specialization"></textarea>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>List Of Awards</label>
                                <textarea name="list_of_awards" id="myeditor2" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Work Experience</label>
                                <textarea name="work_experience" class="form-control" id="myeditor3" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Education & Training</label>
                                <textarea name="education_training" class="form-control" id="myeditor4" rows="3"></textarea>
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