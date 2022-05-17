<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';
$userFunctions = new UserFunctions();
$properties = $userFunctions->listProperties(null,null,null,null,null,null,null)["message"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "templates/seo-header.php"?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include "templates/navbar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "templates/sidebar.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Verified Properties</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Verified Properties</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Verified Properties</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>Property ID</th>
                      <th>Property Name</th>
                      <th>Location</th>
                      <th>Cost</th>
                      <th>Ownership Type</th>
                      <th>Seller ID</th>
                      <th>Seller Name</th>
                      <th>Manage</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($properties as $property){
                      ?>
                      <tr>
                          <td><?=$property["property_id"]?></td>
                          <td><?=$property["title"]?></td>
                          <td><?=$property["location"]?></td>
                          <td><?=$property["value"]?></td>
                          <td><?=$property["ownership_type"]?></td>
                          <td><?=$property["seller_id"]?></td>
                          <td><?=$property["seller_name"]?></td>
                          <td><a type="button" class="deletion-modal btn btn-default" data-toggle="modal" data-target="#modal-lg"
                                 data-id="<?=$property['property_id']?>|<?=$property['title']?>">
                                  Delete
                              </a>
                          </td>
                      </tr>
                      <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Property ID</th>
                      <th>Property Name</th>
                      <th>Location</th>
                      <th>Cost</th>
                      <th>Ownership Type</th>
                      <th>Seller ID</th>
                      <th>Seller Name</th>
                      <th>Manage</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Property</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 id="property-title-h">Property Name</h5>
                        <hr/>
                        <h4>Are you sure you want to delete this property?</h4>

                        <input id="property-id" type="hidden" value="">
                    </div>
                    <div id="verification-response"></div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel-delete-btn">No</button>
                        <button type="button" class="btn btn-primary" id="confirm-delete-btn">Yes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!--footer-->
    <?php include "templates/footer.php"?>
    <!--footer-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admin/plugins/jszip/jszip.min.js"></script>
<script src="../admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="../admin/dist/js/verification.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });
  });

  $('.deletion-modal').click(function () {

      let content = $(this).data('id');
      let res = content.split("|");
      let propertyID = res[0];
      let propertyTitle = res[1];

      $("#property-title-h").html(propertyTitle);

      $('#confirm-delete-btn').on('click',function () {
          confirmDeletion(propertyID);
      });
  });
</script>
</body>
</html>
