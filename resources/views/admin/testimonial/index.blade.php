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
        <h1 class="page-header">testimonialS</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @php $routeName = \Request::route()->getName(); @endphp
                    List of {{ ($routeName == 'testimonial.index') ? 'Active' : 'Trashed' }} testimonials
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @forelse($testimonials as $testimonial)
                                <tr class="odd gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{ $testimonial->title }}</td>
                                    <td><img width="75px" src="{{ url('images/'.$testimonial->image) }}"></td>
                                    <td class="center">
                                    @if($routeName == 'testimonial.index')
                                        <a href="{{ route('testimonial.show', ['testimonial' => $testimonial->id]) }}" target="_blank"><i class="fa fa-eye"></i></a> &nbsp;
                                        <a href="{{ route('testimonial.edit' , ['testimonial' => $testimonial->id]) }}"><i class="fa fa-edit"></i></a> &nbsp;
                                        <a href="" onclick="deletetestimonial( {{ $testimonial->id }} )"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('testimonial.destroy' , ['testimonial' => $testimonial->id]) }}" method="POST" id="delete-form{{ $testimonial->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="javascript:void(0)" onclick="backToList( {{ $testimonial->id }} )"><i class="fa fa-recycle"></i></a>
                                        <form action="{{ route('testimonial.trash-back') }}" method="POST" id="trash-form{{ $testimonial->id }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $testimonial->id }}">
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

        function deletetestimonial(id)
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