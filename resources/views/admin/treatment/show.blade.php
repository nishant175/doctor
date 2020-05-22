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
        <h1 class="page-header">treatment Info</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Below are the treatment details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Treatment Title</th>
                            <td>{{ $treatment->title }}</td>
                            <th>Description</th>
                            <td>{!! $treatment->description !!}</td>
                        </tr><tr>
                            <th>Hospital</th>
                            <td>{!! $treatment->hospital->name !!}</td>
                            <th>Doctor</th>
                            <td>{!! $treatment->doctor->name !!}</td>
                        </tr><tr>
                            <th>Patient Name</th>
                            <td>{!! $treatment->patient_name !!}</td>
                            <th>Patient Age</th>
                            <td>{!! $treatment->patient_age !!}</td>
                        </tr><tr>
                            <th>Patient Mobile</th>
                            <td>{!! $treatment->patient_mobile !!}</td>
                            <th>Patient City</th>
                            <td>{!! $treatment->patient_city !!}</td>
                        </tr><tr>
                            <th>Patient State</th>
                            <td>{!! $treatment->patient_state !!}</td>
                            <th>Patient Pincode</th>
                            <td>{!! $treatment->patient_pincode !!}</td>
                        </tr><tr>
                            <th>Patient Address</th>
                            <td>{!! $treatment->patient_address !!}</td>
                            <th>-</th>
                            <td>-</td>
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