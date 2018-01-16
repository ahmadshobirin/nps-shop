@extends('adminlte.app')


@section('htmlheader_title', 'Data  Produk')
@section('contentheader','Data  Produk')



@section('customcss')
    <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{ route('produk.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @include('admin.displayerror')
            <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                    <tr>
                        <th style="width:15%">No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th class="nosort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach ($dataProduk as $produk)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$produk->code}}</td>
                            <td>{{$produk->name}}</td>
                            <td>{{$produk->category->name}}</td>
                            <td> <span title="{{$produk->deskripsi}}">{{str_limit($produk->deskripsi,30,'(...)')}}</span> </td>
                            <td>
                                <a href="{{ route('produk.edit',$produk->id) }}" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span></a>

                                <a href="{{ route('produk.destroy',$produk->id) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        <span class="fa fa-trash"></span>
                                </a>

                                <form id="delete-form" action="{{ route('produk.destroy',$produk->id) }}" method="POST" style="display: none;">
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
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
