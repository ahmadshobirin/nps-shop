@extends('adminlte.app')


@section('htmlheader_title', 'Data Customer')
@section('contentheader','Data Customer')


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

            <form action="{{ route('customer.update',$customer->id) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('put') }}
                <div class="box-body">
                    @include('admin.displayerror')
                    <div class="form-group">
                        <label class=" control-label">Nama Customer <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Customer..." maxlength="30"value="{{ $customer->name }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Telpon</label>
                        <input type="text" name="telephone" class="form-control" placeholder="Telpon..." maxlength="13" onkeypress='return event.charCode >= 48 && event.charCode <= 57'value="{{ $customer->telephone }}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <textarea name="address" class="form-control" placeholder="Alamat...">{{ $customer->address }}</textarea>
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
        $("#select2").select2();
    })
</script>
@stop
