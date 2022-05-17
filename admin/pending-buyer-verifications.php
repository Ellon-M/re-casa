<?php

use App\Processors\UserFunctions;

require_once 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

$pendingBuyerVerifications = $userFunctions->listBuyerVerificationDetails()["message"];

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
  <?php include 'templates/sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pending Buyer Verifications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pending Buyer Verifications</li>
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
                <h3 class="card-title">Pending Buyer Verifications</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Verification</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($pendingBuyerVerifications as $buyer){
                      ?>
                      <tr>
                          <td><?=$buyer["name"]?></td>
                          <td><?=$buyer["email"]?></td>
                          <td><?=$buyer["phone_number"]?></td>
                          <td><a type="button" class="open-verification btn btn-default" data-toggle="modal" data-target="#modal-lg"
                                      data-id="<?=$buyer['name']?>|<?=$buyer['id_url']?>|<?=$buyer['statement_url']?>|<?=$buyer['user_id']?>">
                                  Verify
                              </a></td>
                      </tr>
                      <?
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>ID Confirmation</th>
                    <th>Statement Confirmation</th>
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
              <h4 class="modal-title">Buyer Verification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 id="buyer-name-h">Buyer Name</h5>
                <hr/>
              <h4>ID Copy</h4>
              <div class="col-sm-2">
                <a id="id-a" href="" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                  <img id="id-img" class="img-fluid mb-2"
                       src="">
                </a>
              </div>
              <h4>Bank Statement</h4>
              <div class="col-sm-2">
                <a id="statement-a" href="" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                  <img id="statement-img" class="img-fluid mb-2"
                       src="">
                </a>
              </div>
                <input id="buyer-id" type="hidden" value="">
            </div>
              <div id="verification-response"></div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" id="deny-buyer-btn">Deny</button>
              <button type="button" class="btn btn-primary" id="verify-buyer-btn">Verify</button>
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
  <?php include 'templates/footer.php'?>

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
<!--<script src="../admin/dist/js/demo.js"></script>-->
<!-- Page specific script -->
</body>
</html>
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

        let urls = $(this).data('id');
        let res = urls.split("|");
        let buyerName = res[0];

        let statementUrl = '/admin/' + res[2];
        let idUrl = '/admin/'+res[1];

        let buyerID = res[3];

        $("#statement-url").html(statementUrl);
        $("#id-url").html(idUrl);
        $("#buyer-name-h").html(buyerName);

        $("#statement-img").attr("src",statementUrl);
        $("#id-img").attr("src",idUrl);

        $("#id-a").attr("href",idUrl);
        $("#statement-a").attr("href",statementUrl);

        $('#verify-buyer-btn').on('click',function () {
            buyerVerification(buyerID,true);
        });
        $('#deny-buyer-btn').on('click',function () {
            buyerVerification(buyerID,false);
        });
    });


</script>
