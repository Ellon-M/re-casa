<?php
$propertyID = filter_input(INPUT_GET,"property",FILTER_SANITIZE_NUMBER_INT);

if ($propertyID == null){
    header('Location: home');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'templates/seo-header.php'?>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libs CSS -->
    <link href="static/css/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="static/vendor/owl-carousel/owl.carousel.css" media="screen">
    <link rel="stylesheet" href="static/vendor/owl-carousel/owl.theme.css" media="screen">
    <link rel="stylesheet" href="static/vendor/flexslider/flexslider.css" media="screen">
    <link rel="stylesheet" href="static/vendor/chosen/chosen.css" media="screen">

    <!-- Theme -->
    <link href="static/css/theme-animate.css" rel="stylesheet">
    <link href="static/css/theme-elements.css" rel="stylesheet">
    <link href="static/css/theme-blog.css" rel="stylesheet">
    <link href="static/css/theme-map.css" rel="stylesheet">
    <link href="static/css/theme.css" rel="stylesheet">

    <!-- Theme Responsive-->
    <link href="static/css/theme-responsive.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="page">
    <?php include_once 'templates/navigation-bar.php'?>

    <!-- Begin Main -->
    <div role="main" class="main pgl-bg-grey">
        <!-- Begin content with sidebar -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 content">
                    <h3><strong>Seller Verification</strong></h3>
                    <div class="contact">
                        <form id="contact-form" name="form1" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="verify-seller-copy-of-id">Front Side Picture/Copy of Contact Seller's ID*</label>
                                        <input type="file" id="verify-seller-copy-of-id" class="form-control" data-msg-required="Copy of ID" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="verify-seller-title">Clear Picture of Listed Property*</label>
                                        <input type="file" id="verify-seller-title" class="form-control" data-msg-required="Bank Statement" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="verify-seller-title">Payment Verification Code*</label>
                                        <input type="text" id="verify-seller-transaction-code" class="form-control" data-msg-required="MPESA Transaction code" placeholder="Enter MPESA code or Paypal ID here" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="verify-user-id" value="<?=$userID?>">
                            <input type="hidden" id="verify-seller-property-id" value="<?=$propertyID?>">
                            <div class="form-group">
                                <div id="verify-seller-response-div">

                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" onclick="verifySeller(event)" value="Submit" class="btn btn-primary min-wide" data-loading-text="Loading...">
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6 sidebar">
                    <h3><strong>How to pay via mpesa</strong></h3>
                    <ul>
                        <li>Go to MPESA</li>
                        <li>Select LIPA na MPESA</li>
                        <li>Select Buy Goods and Services</li>
                        <li>Enter Till No: <strong>5928389</strong></li>
                        <li>Enter Amount: <strong>Ksh 1200.00</strong> Then Enter MPESA PIN</li>
                        <li>Enter the transaction code in the Seller Verification Form and Submit.</li>
                    </ul>
                    <h3><strong>How to pay via paypal</strong></h3>
                    <ul>
                        <li>Log in to your Paypal</li>
                        <li>Select Send Money at the top of the page</li>
                        <li>Enter recipient Paypal ID: <strong>pay@casavenida.com</strong></li>
                        <li>Enter the amount: <strong>US$ 12.00</strong></li>
                        <li>Review details and payment and click Send Money</li>
                        <li>Enter your Paypal ID in the Seller Verification Form and Submit.</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End content with sidebar -->

    </div>
    <!-- End Main -->

    <!-- Begin footer -->
    <?php include_once 'templates/page-footer.php'?>
    <!-- End footer -->

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="static/vendor/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="static/bootstrap/js/bootstrap.min.js"></script>
<script src="static/vendor/owl-carousel/owl.carousel.js"></script>
<script src="static/vendor/flexslider/jquery.flexslider-min.js"></script>
<script src="static/vendor/chosen/chosen.jquery.min.js"></script>
<script src="static/vendor/jquery.validation/jquery.validation.js"></script>
<script src="static/vendor/masonry/imagesloaded.pkgd.min.js"></script>
<script src="static/vendor/masonry/masonry.pkgd.min.js"></script>
<!-- Google Map -->
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="static/vendor/jquery.gmap.js"></script>

<!-- Theme Initializer -->
<script src="static/js/theme.plugins.js"></script>
<script src="static/js/theme.js"></script>

<!-- Contact Settings -->
<script src="static/js/contact.js"></script>
<!--Forms-->
<script src="static/js/forms.js"></script>

</body>
</html>