@extends('adminlte.app')


@section('htmlheader_title', 'Data Kategori Produk')
@section('contentheader','Data Kategori Produk')



@section('customcss')
    <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{ route('kategori-produk.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @include('admin.displayerror')
            <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                    <tr>
                        <th style="width:15%">No.</th>
                        <th style="width:70%">Nama</th>
                        <th class="nosort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($kategoriProuduk as $key => $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->name }}</td>
                            <td>
                                <a href="{{ route('kategori-produk.edit',$value->id) }}" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span></a>

                                <a href="{{ route('kategori-produk.destroy',$value->id) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        <span class="fa fa-trash"></span>
                                </a>

                                <form id="delete-form" action="{{ route('kategori-produk.destroy',$value->id) }}" method="POST" style="display: none;">
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
            { "orderable": false, "targets": 4 }
          ]
        });
    </script>
@stop
