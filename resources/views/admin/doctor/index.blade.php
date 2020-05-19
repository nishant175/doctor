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
        <h1 class="page-header">DOCTORS</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @php $routeName = \Request::route()->getName(); @endphp
                    List of {{ ($routeName == 'doctor.index') ? 'Active' : 'Trashed' }} doctors
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Doctor Name</th>
                                    <th>Designation</th>
                                    <th>Experience</th>
                                    <th>Qualification</th>
                                    <th>Hosplital</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @forelse($doctors as $doctor)
                                <tr class="odd gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->designation }}</td>
                                    <td class="center">{{ $doctor->experience }}</td>
                                    <td class="center">{{ $doctor->qualification }}</td>
                                    <td class="center">{{ $doctor->hospital->name }}</td>
                                    <td class="center">
                                    @if($routeName == 'doctor.index')
                                        <a href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}" target="_blank"><i class="fa fa-eye"></i></a> &nbsp;
                                        <a href="#"><i class="fa fa-edit"></i></a> &nbsp;
                                        <a href="" onclick="deleteDoctor( {{ $doctor->id }} )"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('doctor.destroy' , ['doctor' => $doctor->id]) }}" method="POST" id="delete-form{{ $doctor->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="#"><i class="fa fa-recycle"></i></a>
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

        function deleteDoctor(id)
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
    </script>
@endpush

@endsection