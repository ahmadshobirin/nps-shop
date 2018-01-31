@extends('adminlte.app')


@section('htmlheader_title', 'Transaksi')
@section('contentheader','Transaksi')



@section('customcss')
    <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
    <link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}">
    <link href="{{asset('plugins/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/daterangepicker.css')}}" rel="stylesheet" />
    <style>
        .required{
            color: red;
            font-size: 12px;
        }
    </style>
@stop

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{ route('transaksi.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
                <a class="btn btn-default btn-md" data-toggle="modal" data-target="#print" id="btnprintout">
                    <i class="fa fa-file"></i> View Report
                </a>
                <a  href="javascript:;" data-toggle="modal" data-target="#print" id="btnprint" class="btn btn-warning btn-md">
                    <i class="fa fa-file-pdf-o"></i> Export to PDF
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

                                @if( $value->type == 'unpaid' )
                                    <a href="{{ route('transaksi.edit',$value->id_transaction) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit ?"><span class="fa fa-pencil"></span></a>

                                    <a href="{{ route('transaksi.destroy',$value->id_transaction) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus ?" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')">
                                        <span class="fa fa-trash"></span>
                                    </a>                                    
                                @endif
                                
                                <a href="{{ route('transaksi.detail',$value->id_transaction) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail ?"><span class="fa fa-external-link"></span></a>

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
            <div id="print" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Print Out Customer</h4>
                    </div>
                    <form action="{{ url('transaksi/report') }}" method="get">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Periode</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="periode" name="periode" value="">
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label>Status Bayar</label>
                                <select class="select2 form-control" name="status" id="" style="width: 100%;">
                                    <option selected value="">Pilih Status Bayar...</option>
                                    <option value="paid">Lunas</option>
                                    <option value="unpaid">Hutang</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Customer</label>
                                <select class="select2 form-control" name="customer" id="customer" style="width: 100%;">
                                    <option selected value="">Pilih Customer...</option>
                                    @foreach($customerTrans as $customer)
                                        <option value="{{ $customer->id }}">{{ ucfirst($customer->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Barang</label>
                                <select name="barang" id="barang" class="form-control select2" style="width:100%"><
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $barang)
                                        <option value="{{ $barang->id }}">{{ ucfirst($barang->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="type" value="" class="form-control" id="type">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-md" value="Print" id="submitButton">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/bootstrap-timepicker.min.js')}}"></script>
    <script type="text/javascript">

        $('.select2').select2();

        $('#table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 4 }
            ]
        });

        $('#btnprintout').click(function(){
            $('#type').val("view");
            $('#submitButton').val("View");
            $('#submitButton').removeClass("btn-warning");
            $('#submitButton').addClass("btn-primary");
        });

        $('#btnprint').click(function(){
            $('#type').val("download");
            $('#submitButton').val("Export Pdf");
            $('#submitButton').removeClass("btn-primary");
            $('#submitButton').addClass("btn-warning");
        });

        $('#periode').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
        });

    </script>
@stop
