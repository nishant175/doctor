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
        <h1 class="page-header">Categories</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @php $routeName = \Request::route()->getName(); @endphp
                    List of {{ ($routeName == 'category.index') ? 'Active' : 'Trashed' }} categories
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @forelse($categories as $category)
                                <tr class="odd gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="center">
                                    @if($routeName == 'category.index')
                                        <a href="{{ route('category.show', ['category' => $category->id]) }}" target="_blank"><i class="fa fa-eye"></i></a> &nbsp;
                                        <a href="{{ route('category.edit' , ['category' => $category->id]) }}"><i class="fa fa-edit"></i></a> &nbsp;
                                        <a href="" onclick="delete( {{ $category->id }} )"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('category.destroy' , ['category' => $category->id]) }}" method="POST" id="delete-form{{ $category->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="javascript:void(0)" onclick="backToList( {{ $category->id }} )"><i class="fa fa-recycle"></i></a>
                                        <form action="{{ route('category.trash-back') }}" method="POST" id="trash-form{{ $category->id }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $category->id }}">
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

        function deletecategory(id)
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