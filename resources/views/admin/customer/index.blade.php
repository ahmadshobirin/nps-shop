@extends('adminlte.app')


@section('htmlheader_title', 'Data Customer')
@section('contentheader','Data Customer')



@section('customcss')
    <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{ route('customer.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @include('admin.displayerror')
            <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Customer</th>
                        {{--  <th>Alamat</th>  --}}
                        <th>Telpon</th>
                        <th class="nosort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($dataCustomer as $key => $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->name }}</td>
                            {{--  <td>{{ $value->address }}</td>  --}}
                            <td>{{ $value->telephone }}</td>
                            <td>
                                <a href="{{ route('customer.edit',$value->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><span class="fa fa-pencil"></span></a>

                                <a href="{{ route('customer.destroy',$value->id) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                        <span class="fa fa-trash"></span>
                                </a>

                                <form id="delete-form" action="{{ route('customer.destroy',$value->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                    <input type="submit" value="delete" style="display: none;">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $('#table').DataTable({
            "columnDefs": [
            { "orderable": false, "targets": 3 }
         ]
        });

        
        
    </script>
@stop
