@extends('adminlte.app')


@section('htmlheader_title', 'Transaksi')
@section('contentheader','Transaksi')



@section('customcss')
    <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{ route('transaksi.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @include('admin.displayerror')
            <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Customer</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th class="nosort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($dataTransaksi as $key => $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ date('d-m-Y',strtotime($value->date_transaction)) }}</td>
                            <td>{{ ($value->type == 'paid') ? 'Lunas' : 'Hutang' }}</td>
                            <td>
                                {{--  <a href="{{ route('customer.edit',$value->id) }}" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span></a>  --}}
                                
                                <a href="{{ route('transaksi.detail',$value->id_transaction) }}" class="btn btn-primary btn-sm"><span class="fa fa-external-link"></span></a>

                                {{--  <a href="{{ route('customer.destroy',$value->id_transaction) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                        <span class="fa fa-trash"></span>
                                </a>

                                <form id="delete-form" action="{{ route('customer.destroy',$value->id_transaction) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                    <input type="submit" value="delete" style="display: none;">
                                </form>  --}}
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
