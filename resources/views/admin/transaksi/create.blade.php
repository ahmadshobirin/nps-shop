@extends('adminlte.app')


@section('htmlheader_title', 'Transaksi')
@section('contentheader','Transaksi')


@section('customcss')
<link rel="stylesheet" href="{{ URL::asset('css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}">
<style media="screen">
    .required{
        color: red;
        font-size: 12px;
        font-weight: bold;
    }
</style>
@stop

@section('main-content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-info">

            <form action="!#" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('post') }}
                <div class="box-body">
                    @include('admin.displayerror')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Nama Customer <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="customer_id" id="customer">
                                    <option value="">Pilih Customer</option>

                                    @foreach ($allCustomer as $customer)
                                        <option value="{{ $customer->id  }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telpon</label>
                                <input type="text" id="telpon-customer" readonly class="form-control input-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea id="alamat-customer" rows="1"  class="form-control input-sm" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Kategori Produk <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="customer_id" id="kategori">
                                    <option value="">Pilih Kategori Produk</option>

                                    @foreach ($kategoriProduk as $kategori)
                                        <option value="{{ $kategori->id  }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Pilih Barang <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="customer_id" id="barang">
                                    <option value="">Pilih Barang</option>


                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{ route('customer.index')}}" class="btn btn-info">Kembali</a>
                        <input type="reset" class="btn btn-danger" value="Batal">
                        <input  type="submit" class="btn btn-success" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@stop
@section('scripts')
<script type="text/javascript" src="{{URL::asset('/plugins/select2.full.min.js')}}"></script>
<script type="text/javascript">
    var langId = "{{asset('vendor/select2/js/i18n/id.js')}}";
    $(document).ready(function () {
        $(".select2").select2();

        $("#customer").on("change",function(){

            $.ajax({
                url : "<?= url('/transaksi/get-customer') ?>/" + $(this).val(),
                method : "GET",
                success : function(customer){
                    console.log(customer);
                    $('#telpon-customer').val(customer.telephone);
                    $('#alamat-customer').val(customer.address);
                },
            });
        });

        $("#kategori").on("change",function(){

            $.ajax({
                url : "<?= url('/transaksi/get-produk-by-kategori') ?>/" + $(this).val(),
                method : "GET",
                success : function(produk){
                    console.log(produk);

                    $('#barang').children('option:not(:first)').remove().end();

                    $.each(produk,function(index,obj){
                        $('#barang').append('<option value="'+obj.id+'"> '+obj.name+' </option>');
                    });
                },
            });
        });
    });
</script>
@stop
