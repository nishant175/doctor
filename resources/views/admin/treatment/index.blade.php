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
        <h1 class="page-header">treatments</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @php $routeName = \Request::route()->getName(); @endphp
                    List of {{ ($routeName == 'treatment.index') ? 'Active' : 'Trashed' }} treatments
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Treatment Title</th>
                                    <th>Hospital</th>
                                    <th>Doctor</th>
                                    <th>Patient Name</th>
                                    <th>Patient Mobile</th>
                                    <th>Patient City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @forelse($treatments as $treatment)
                                <tr class="odd gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{ $treatment->title }}</td>
                                    <td>{!! $treatment->hospital->name !!}</td>
                                    <td>{!! $treatment->doctor->name !!}</td>
                                    <td>{!! $treatment->patient_name !!}</td>
                                    <td>{!! $treatment->patient_mobile !!}</td>
                                    <td>{!! $treatment->patient_city !!}</td>
                                    <td class="center">
                                    @if($routeName == 'treatment.index')
                                        <a href="{{ route('treatment.show', ['treatment' => $treatment->id]) }}" target="_blank"><i class="fa fa-eye"></i></a> &nbsp;
                                        <a href="{{ route('treatment.edit' , ['treatment' => $treatment->id]) }}"><i class="fa fa-edit"></i></a> &nbsp;
                                        <a href="" onclick="deletetreatment( {{ $treatment->id }} )"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('treatment.destroy' , ['treatment' => $treatment->id]) }}" method="POST" id="delete-form{{ $treatment->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="javascript:void(0)" onclick="backToList( {{ $treatment->id }} )"><i class="fa fa-recycle"></i></a>
                                        <form action="{{ route('treatment.trash-back') }}" method="POST" id="trash-form{{ $treatment->id }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $treatment->id }}">
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                            @php $i++; @endphp
                            @empty
                                
                            @endforelse
                            </tbody>
                        </table>
                    </div>
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

        function deletetreatment(id)
        {
            event.preventDefault();
            var x = confirm('Are you sure you wants to delete?');
            if(x)
            {
                document.getElementById('delete-form'+id).submit();
            }
            else
            {
                return false;
            }
        }

        function backToList(id)
        {
            event.preventDefault();
            var x = confirm('Are you sure?');
            if(x)
            {
                document.getElementById('trash-form'+id).submit();
            }
            else
            {
                return false;
            }
        }
    </script>
@endpush

@endsection