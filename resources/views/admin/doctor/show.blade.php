@extends('admin.layouts.app')

@section('content')

@push('head')
    <!-- DataTables CSS -->
    <link href="{{ asset('admin-theme/startmin-master') }}/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('admin-theme/startmin-master') }}/css/dataTables/dataTables.responsive.css" rel="stylesheet">
@endpush

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Doctor Info</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Below are the doctor details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $doctor->name }}</td>
                            <th>Hospital</th>
                            <td>{{ $doctor->hospital->name }}</td>
                        </tr><tr>
                            <th>Designation</th>
                            <td>{{ $doctor->designation }}</td>
                            <th>Category</th>
                            <td>{{ $doctor->category->name }}</td>
                            
                            
                        </tr><tr>
                            <th>Experience</th>
                            <td>{{ $doctor->experience }}</td>
                            <th>Qualification</th>
                            <td>{{ $doctor->qualification }}</td>
                            
                            
                        </tr><tr>
                            <th>Speciality</th>
                            <td>{{ $doctor->speciality }}</td>
                            <th>About Doctor</th>
                            <td>{!! $doctor->about !!}</td>
                            
                        </tr><tr>
                            <th>List Of Awards</th>
                            <td>{!! $doctor->list_of_awards !!}</td>
                            <th>Work Experience</th>
                            <td>{!! $doctor->work_experience !!}</td>
                        </tr><tr>
                            <th>Specialization</th>
                            <td>{!! $doctor->specialization !!}</td>
                            <th>Education Training</th>
                            <td>{!! $doctor->education_training !!}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
<!-- /.row -->

@push('foot')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('admin-theme/startmin-master') }}/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin-theme/startmin-master') }}/js/dataTables/dataTables.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
    </script>
@endpush

@endsection