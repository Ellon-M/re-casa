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
			<!-- Begin page top -->
			
			<!-- End page top -->
			
			<!-- Begin content with sidebar -->
			<div class="container">
				<div class="row">
					<div class="col-md-9 content">
						
						<div class="contact">
							<p>For enquiries on contacting a seller or getting listed on our website, email us at <a href="mailto:info@casavenida.com" data-original-title="Email">info@casavenida.com</a> or reach out to us via the form provided below.
							
                            </p>
							<div class="row">
								<div class="col-sm-6">
<!--									<strong>Your address</strong>-->
<!--									<address>129/6 tristique eu eleifend sit amet, tincid unt afringilla rhoncus lacus in condimentum.</address>-->
								</div>
							
							</div>
							<hr>
							<form id="contact-form" name="form1" method="post">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="name">Your Name*</label>
											<input type="text" id="contact-name" class="form-control" data-msg-required="Please enter your name." required>
										</div>
										<div class="col-sm-6">
											<label for="customer_mail">Your Email*</label>
											<input type="email" id="contact-customer-mail" class="form-control" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="subject">Subject*</label>
											<input type="text" id="contact-subject" class="form-control" data-msg-required="Please enter the subject." required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="contact-message">Your Message*</label>
									<textarea rows="9" id="contact-message" class="form-control" data-msg-required="Please enter your message." required></textarea>
								</div>
                                <div class="form-group">
                                    <div id="contact-response-div"></div>
                                </div>
								<div class="form-group">
									<input type="submit" value="Submit" onclick="contactUs(event)" class="btn btn-primary min-wide" data-loading-text="Loading...">
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

	<!-- Theme Initializer -->
	<script src="static/js/theme.plugins.js"></script>
	<script src="static/js/theme.js"></script>
	
	<!-- Contact Settings -->
	<script src="static/js/contact.js"></script>
    <!--  Forms -->
	<script src="static/js/forms.js"></script>

</body>
</html>