@extends('admin.layouts.app')

@section('content')

@push('head')
@endpush




<form style="margin-top:50px" method="POST" enctype="multipart/form-data" action="{{ route('image-upload.upload') }}">
    @csrf

    {{-- Name/Description fields, irrelevant for this article --}}

    <div class="form-group">
        <input type="file" name="file">
    </div>
    <div>
        <input class="btn btn-danger" type="submit">
    </div>
</form>

@endsection