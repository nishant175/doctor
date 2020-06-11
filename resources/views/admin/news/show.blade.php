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
        <h1 class="page-header">hospital Info</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Below are the hospital details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $hospital->name }}</td>
                            <th>Description</th>
                            <td>{!! $hospital->description !!}</td>
                        </tr><tr>
                            <th>Team Specialities</th>
                            <td>{!! $hospital->team_specialities !!}</td>
                            <th>Infrastructure</th>
                            <td>{!! $hospital->infrastructure !!}</td>
                            
                            
                        </tr><tr>
                            <th>Address</th>
                            <td>{!! $hospital->address !!}</td>
                            <th>Facilities</th>
                            <td>{!! $hospital->facilities !!}</td>
                            
                            
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