<!-- jQuery 3 -->
<script src="{{URL::asset('/js/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{URL::asset('/js/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('/js/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('/js/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('/js/dist/js/demo.js')}}"></script>
<script src="{{URL::asset('/js/jquery-ui.js')}}"></script>
@yield('scripts')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>