<?php

use App\Processors\UserFunctions;

require_once 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

$pendingPropertyVerifications = $userFunctions->listSellerVerificationDetails()["message"];
//$pendingBuyerVerifications = $userFunctions->listBuyerVerificationDetails()["message"];

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
  <?php include 'templates/navbar.php'?>
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
            <h1>Pending Property Verification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pending Property Verification</li>
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
                <h3 class="card-title">Pending Property Verification</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Property Title</th>
                    <th>Seller Name</th>
                    <th>Seller Phone Number</th>
                    <th>Seller Email</th>
                    <th>Transaction Code</th>
                    <th>Verification</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?foreach ($pendingPropertyVerifications as $seller){
                      ?>
                      <tr>
                          <td><?=$seller['property_title']?></td>
                          <td><?=$seller['name']?></td>
                          <td><?=$seller['phone_number']?></td>
                          <td><?=$seller['email']?></td>
                          <td><?=$seller['transaction_code']?></td>
                          <td><button type="button" class="open-verification btn btn-default" data-toggle="modal" data-target="#modal-lg"
                              data-id="<?=$seller['name']?>|<?=$seller['ownership_title_url']?>|<?=$seller['id_url']?>|<?=$seller['user_id']?>|<?=$seller['property_id']?>">
                                  Verify
                              </button></td>
                      </tr>
                      <?
                  }?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Property Title</th>
                      <th>Seller Name</th>
                      <th>Seller Phone Number</th>
                      <th>Seller Email</th>
                      <th>Transaction Code</th>
                      <th>Verification</th>
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
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Property Verification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h4 id="seller-name-h">Seller Name</h4>
                <hr/>
              <h4>Title</h4>
              <div class="col-sm-2">
                <a id="title-a" href="" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                  <img id="title-img" class="img-fluid mb-2"
                       src="">
                </a>
              </div>
              <h4>ID</h4>
              <div class="col-sm-2">
                <a id="id-a" href="" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                  <img id="id-img" class="img-fluid mb-2"
                       src="">
                </a>
              </div>
            </div>
              <div id="verification-response"></div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" id="deny-property-btn">Deny</button>
              <button type="button" class="btn btn-primary" id="verify-property-btn">Verify</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Footer -->
  <?php include "templates/footer.php";?>
    <!-- Footer -->

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
<script src="../admin/dist/js/verification.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="../admin-realestate/dist/js/demo.js"></script>-->
<!-- Page specific script -->
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

  $('.open-verification').click(function () {
      console.log("Clicked");
      let urls = $(this).data('id');
      let res = urls.split("|");
      let sellerName = res[0];

      let idUrl = '/admin/'+res[2];
      let titleUrl = '/admin/'+res[1];

      let userID = res[3];
      let propertyID = res[4];
      $("#id-url").html(idUrl);
      $("#title-url").html(titleUrl);
      $("#seller-name-h").html(sellerName);

      $("#title-img").attr("src",titleUrl);
      $("#id-img").attr("src",idUrl);

      $("#id-a").attr("href",idUrl);
      $("#title-a").attr("href",titleUrl);

      $("#verify-property-btn").on('click',function () {
          propertyVerification(userID,propertyID,true);
      });

      $("#deny-property-btn").on('click',function () {
          propertyVerification(userID,propertyID,false);
      });
  });
</script>
</body>
</html>
