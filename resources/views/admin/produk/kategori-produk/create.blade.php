@extends('adminlte.app')


@section('htmlheader_title', 'Data Kategori Produk')
@section('contentheader','Data Kategori Produk')


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

            <form action="{{ route('kategori-produk.store') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('post') }}
                <div class="box-body">
                    @include('admin.displayerror')
                    <div class="form-group">
                        <label class=" control-label">Nama Kategori <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Kategori..." maxlength="30">
                    </div>
                </div>

                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{ route('kategori-produk.index')}}" class="btn btn-info">Kembali</a>
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
        $("#select2").select2();
    })
</script>
@stop
