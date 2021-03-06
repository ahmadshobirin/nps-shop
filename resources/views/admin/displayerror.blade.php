<br>
<div class="">
@if (count($errors)>0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong><br><br>
        @foreach($errors->all() as $error)
            {{$error}}
            <br>
        @endforeach
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-warning"></i> {{Session::get('message')}}
    </div>
@endif

@if(Session::has('message-success'))
    <div class="alert  alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-check"></i> {{Session::get('message-success')}}
    </div>
@endif
</div>
