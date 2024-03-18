</div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <span class="text-info">HilmiPos</span></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap -->
<script src="<?= $main_url ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= $main_url ?>asset/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= $main_url ?>asset/plugins/chart.js/Chart.min.js"></script>
<script src="<?= $main_url ?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $main_url ?>asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $main_url ?>asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $main_url ?>asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $main_url ?>asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= $main_url ?>asset/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
  $(function(){
    $('#tblData').DataTable();
  })
</script>

</body>
</html>