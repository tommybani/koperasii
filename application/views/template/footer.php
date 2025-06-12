<footer class="main-footer">

    <strong>Copyright &copy; Aeny Azimah Kafabih </strong> Koperasi Serba Usaha "Karya Sejahtera"
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script src="<?=base_url()?>assets/select2/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

function validate() {
    $("#file_error").html("");
    $(".demoInputBox").css("border-color","#F0F0F0");
    var file_size = $('#file')[0].files[0].size;
    if(file_size>2097152) {
        $("#file_error").html("Maximal Ukuran File 2MB");
        $(".demoInputBox").css("border-color","#FF0000");
        return false;
    } 
    return true;
}



</script>
<?php (isset($js)) ? $this->load->view($js) : ''?>
</body>
</html>
