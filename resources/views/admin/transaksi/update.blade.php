@extends('adminlte.app')


@section('htmlheader_title', 'Transaksi')
@section('contentheader','Transaksi')


@section('customcss')
<link rel="stylesheet" href="{{ URL::asset('css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}">
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

            <form action="{{ route('transaksi.update',$header->id_transaction) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('patch') }}
                <div class="box-body">
                    @include('admin.displayerror')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Nama Customer <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="customer_id" id="customer" disabled>
                                    <option value="">Pilih Customer...</option>

                                    @foreach ($allCustomer as $customer)
                                        <option @if($header->customer_id == $customer->id) selected @endif value="{{ $customer->id  }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telpon</label>
                                <input type="text" id="telpon-customer" readonly class="form-control input-sm" value="{{ $header->telephone }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea id="alamat-customer" rows="1"  class="form-control input-sm" readonly> {{ $header->address }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tipe Beli <span class="required">*</span></label>
                                <select name="type" class="form-control input-sm" required id="type-beli">
                                    <option value="">Pilih Tipe Beli...</option>
                                    <option @if( $header->type == 'paid' ) selected  @endif value="paid">Lunas</option>
                                    <option @if( $header->type == 'unpaid' ) selected  @endif value="unpaid">Hutang</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Tanggal Bayar <span class="required" id="required-tgl-bayar" style="display:none">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="datepicker1" class="form-control input-sm" name="payment_date" value="" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sumber</label>
                                <input type="text" class="form-control" value="{{ $header->source }}" maxlength='30' readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        {{--  <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Kategori Produk <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="kategori" id="kategori" required>
                                    <option value="">Pilih Kategori Produk...</option>

                                    @foreach ($kategoriProduk as $kategori)
                                        <option value="{{ $kategori->id  }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" control-label">Pilih Barang <span class="required">*</span></label>
                                <select class="form-control input-sm select2" name="" id="barang">
                                    <option value="">Pilih Barang...</option>
                                </select>
                            </div>
                        </div>  --}}
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan </label>
                                    <textarea name="deskripsi" class="form-control input-sm" readonly id="deskripsi">{{ $header->deskripsi }}</textarea>
                                </div>
                            </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th width="20%">Barang</th>
                                        <th width="15%">Harga Beli</th>
                                        <th width="15%">Harga Jual</th>
                                        <th>Qty</th>
                                        <th width="15%">Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php $i = 1; $subTotal = 0;?>
                                    @foreach($detail as $data)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>Rp. {{ number_format($data->purchase_price,0,'.','.') }} </td>
                                            <td>Rp. {{ number_format($data->selling_price,0,'.','.') }} </td>
                                            <td>{{ $data->qty }}</td>
                                            <td>Rp. {{ number_format($data->subTotal,0,'.','.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-9">
                                <div class="pull-right">
                                    <label for=""><b>Total Harga </b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">Rp.</span>
                                        <input type="text" id="total" class="total form-control input-sm" value="{{number_format($header->grand_total,0,'.','.')}}" readonly>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{ route('transaksi.index')}}" class="btn btn-info">Kembali</a>
                        {{--  <input type="reset" class="btn btn-danger" value="Batal">  --}}
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
<script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">
    var langId = "{{asset('vendor/select2/js/i18n/id.js')}}";
    var produk = [];
    $(document).ready(function () {
        $(".select2").select2();

        //disable total
		$("#total").keypress(function (evt) {
			evt.preventDefault();
		});

		$("#total").keydown(function (evt) {
			evt.preventDefault();
		});

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

        

        $('#type-beli').on("change",function(){

            //alert($(this).val());
            if( $(this).val() == 'paid' ){
                $('#required-tgl-bayar').show();
                $('#datepicker1').attr('readonly',false);
                $('#datepicker1').attr('disabled',false);
                $('#datepicker1').attr('required',true);

                $('#deskripsi').attr('readonly',false);
                

                var today = new Date();
                //var result = today.setDate(date.getDate() + 1);

                $('#datepicker1').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true,
                    startDate: today,
                    weekStart: 1,
                });

                $('#datepicker1').datepicker('setDate', today);
            }else{
                $('#required-tgl-bayar').hide();
                $('#datepicker1').attr('readonly',true);
                $('#datepicker1').attr('disabled',true);
                $('#datepicker1').attr('required',false);
                $('#datepicker1').val('');

                $('#deskripsi').attr('readonly',true);
            }
        });

        $('#kategori').on("change",function(){
            
            $("#tbody").find("tr").remove();
            $('.total').val('')
            produk = [];
            //alert(produk);

            $.ajax({
                url : "<?= url('/transaksi/get-produk-by-kategori') ?>/" + $(this).val(),
                method : "GET",
                success : function(produk){
                    //console.log(produk);

                    $('#barang').children('option:not(:first)').remove().end();

                    $.each(produk,function(index,obj){
                        $('#barang').append('<option value="'+obj.id+'"> '+obj.name+' </option>');
                    });
                },
            });
        });

        
        $("#barang").on('change',function () {

			var id = document.getElementById('barang').value;
			var lengthProduk = produk.length;
			var token = "<?= csrf_token()?>";

			if( $(this).val() != null ){
				$.ajax({
					url: "<?= url('admin/transaksi/get-produk') ?>",
					method: "post",
					data: {
						_token: token,
						id: id,
						length : lengthProduk,
						produk : produk,
					},
					success: function (s) {
						//console.log(s);
						$('#tbody').append(s);
						produk.push(id);
			            lengthProduk = produk.length;
					}
				});
			}

		});
    });

    function hitungSubTotal(idProduk) {
		//alert(idProduk);

		var harga = $('#' + idProduk + '_harga').val();
		var jumlah = $('#' + idProduk + '_jumlah').val();
		//alert(harga);
		var total = 0;
		var subTotal = 0;
        var grandTotal = 0;
        
		( harga != '') ? harga = harga : harga = 0;
		( jumlah != '') ? jumlah = jumlah : jumlah = 0;

		subTotal = parseInt(harga) * parseInt(jumlah);
		
		$('.' + idProduk + '_subTotal').val(parseInt(subTotal));


		if( jumlah != ''){
			$.each(produk,function(index,value){
                var subTotalItem = $('.'+value+'_subTotal').val();
                ( subTotalItem != '') ? subTotalItem = subTotalItem : subTotalItem = 0;

				grandTotal = parseInt( subTotalItem ) + grandTotal;
			});
		}
		$('.total').val(grandTotal);

    }
    
    function hapusBaris(idProduk) {
        // alert(idProduk);
        var getSubTotal = $('#' + idProduk + '_subTotal').val();
        var total = $('#total').val();

        var produk_id = $('#produk_id_'+idProduk).val();
        //alert(produk);
        //alert(produk_id);

        if (confirm('Apakah anda yakin menghapus data ?')) {
            $('#row_'+idProduk).remove();

            
            removeItem = produk_id;
            produk = jQuery.grep(produk, function(value) {
				return value != removeItem;
			});
            //alert(produk);
            
            ( total != '') ? total = total : total = 0;
            ( getSubTotal != '') ? getSubTotal = getSubTotal : getSubTotal = 0;
            jumlahTotal = parseInt(total) - parseInt(getSubTotal);
            $('#total').val(jumlahTotal);

        }
    }
</script>
@stop
