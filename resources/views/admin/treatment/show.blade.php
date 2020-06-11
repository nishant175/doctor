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
                            <th>Introduction</th>
                            <td>{!! $treatment->introduction !!}</td>
                        </tr><tr>
                            <th>Cost</th>
                            <td>{!! $treatment->cost !!}</td>
                            <th>specialization</th>
                            <td>{!! $treatment->specialization !!}</td>
                        </tr><tr>
                            <th>faqs</th>
                            <td>{!! $treatment->faqs !!}</td>
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