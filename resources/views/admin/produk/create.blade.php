@extends('adminlte.app')


@section('htmlheader_title', 'Data Produk')
@section('contentheader','Data Produk')


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
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">

            <form action="{{ route('produk.store') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('post') }}
                <div class="box-body">
                    @include('admin.displayerror')
                    <div class="form-group">
                        <label class=" control-label">Kode Produk <span class="required">*</span></label>
                        <input type="text" name="code" value="" class="form-control" placeholder="" required maxlength="30">
                    </div>

                    <div class="form-group">
                        <label class=" control-label">Kategori Produk <span class="required">*</span></label>
                        <select class="form-control select2" name="kategori_id" required>
                            <option value="">Pilih Kategori...</option>
                            @foreach ($kategoriProduk as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class=" control-label">Nama Produk <span class="required">*</span></label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Nama Produk..." maxlength="30">
                    </div>

                    <div class="form-group">
                        <label class=" control-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{ route('produk.index')}}" class="btn btn-info">Kembali</a>
                        <input type="reset" class="btn btn-danger" value="Batal" id="reset">
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

        $('#reset').on('click',function(){
            $(".select2").val('').trigger('change');
        });
    })
</script>
@stop
