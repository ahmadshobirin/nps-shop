<!DOCTYPE html>
<html>
    @section('htmlheader')
        @include('adminlte.partial.htmlheader')
    @show
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- mainheader -->
  @include('adminlte.partial.mainheader')
  {{-- @section('contentheader') --}}


  <!-- Left side column. contains the sidebar -->
  @include('adminlte.partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('adminlte.partial.contentheader')

    <!-- Main content -->
    <section class="content">

      @yield('main-content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Footer -->
   @include('adminlte.partial.footer')
  <!-- Control Sidebar -->
   @include('adminlte.partial.controlsidebar')

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

@include('adminlte.partial.script')
{{--  yieldcutomscript  --}}
</body>
</html>
