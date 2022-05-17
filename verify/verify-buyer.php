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
					<div class="col-md-9 content">
						<h3><strong>Buyer Verification</strong></h3>
						<div class="contact">
							<form name="form1" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="verify-buyer-copy-of-id">Front Side Picture/Copy of National ID*</label>
											<input type="file" id="verify-buyer-copy-of-id" class="form-control" data-msg-required="Copy of ID" required>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="verify-buyer-statement">Recent Selfie or Passport Photo*</label>
											<input type="file" id="verify-buyer-statement" class="form-control" data-msg-required="Bank Statement" required>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="col-sm-6" id="buyer-response-div">
										</div>
									</div>
								</div>
                                <input type="hidden" id="verify-user-id" value="<?=$userID?>">
								<div class="form-group">
									<input type="submit" value="Submit" onclick="verifyBuyer(event)" class="btn btn-primary min-wide" data-loading-text="Loading...">
								</div>
							</form>
						</div>
						
					</div>
					<div class="col-md-3 sidebar">

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
    <!-- Form -->
	<script src="static/js/forms.js"></script>
	
</body>
</html>