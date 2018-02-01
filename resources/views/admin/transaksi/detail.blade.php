@extends('adminlte.app')


@section('htmlheader_title', 'Transaksi')
@section('contentheader','Transaksi')

@section('customcss')
<link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <table style="border: none;" width="100%">
                        <tr>
                            <td>Customer</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>{{$header->name}}</td>
                        </tr>
                        <tr>
                            <td>Telpon</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>{{$header->telephone}}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>&nbsp;&nbsp;</td>
                            <td><span title="{{ $header->deskripsi }}" style="cursor:pointer">{{str_limit($header->deskripsi,40,' ...')}}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <table style="border: none;">
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ date('d-m-Y',strtotime($header->date_transaction)) }}</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ ($header->type == 'paid') ? 'Lunas' : 'Hutang' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Bayar</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ ( $header->payment_date != null) ? date('d-m-Y',strtotime($header->payment_date)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Rincian</td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td>{{ ( $header->rincian != null) ? $header->rincian : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <table class="table table-striped table-hover table-responsive" id="table-detail">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="15%">Kategori Barang</th>
                        <th width="15%">Kode Barang</th>
                        <th width="15%">Barang</th>
                        {{--  <th width="15%">Harga Beli</th>  --}}
                        <th width="15%">Harga Jual</th>
                        <th>Qty</th>
                        <th width="15%">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $subTotal = 0;?>
                    @foreach($detail as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $data->kategori }}</td>
                            <td>{{ $data->code }}</td>
                            <td>{{ $data->produk }}</td>
                            {{--  <td>Rp. {{ number_format($data->purchase_price,0,'.','.') }} </td>  --}}
                            <td style="text-align:right; padding-right:20px">Rp. {{ number_format($data->selling_price,0,'.','.') }} </td>
                            <td>{{ $data->qty }}</td>
                            <td style="text-align:right; padding-right:20px">Rp. {{ number_format($data->subTotal,0,'.','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-md-offset-7">
                    <div class="pull-right">
                        <table class="" style="">
                            <tr>
                                <td>
                                    <label for="">Grand Total</label>
                                </td>
                                <td style="width:20%"></td>
                                <td>
                                    <b>Rp. {{number_format($header->grand_total,0,'.','.')}}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">

        $('#table-detail').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "language": {
            "emptyTable": "Data Kosong",
            //    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "info": "",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ Data",
                "zeroRecords": "Tidak Ada Data yang Ditampilkan",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sLast": "Akhir",
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya"
                },
            },
            'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
            }],
        });
    </script>
@stop
