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
						<h3><strong>Profile</strong></h3>
                        <div class="contact">
                            <hr/>
                            <h4>Buying</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?if (isset($buyerDetails)){
                                            ?>
                                            <h3>ID Verification Status:  <span class="badge badge-secondary">Verified</span></h3>
                                            <?
                                        }else{
                                            ?>
                                            <h3>ID Verification Status:  <span class="badge badge-secondary">Not Verified</span></h3>
                                            <?
                                        }?>
                                    </div>
                                </div>
                            </div>
                            <?if(!isset($buyerDetails)){
                                ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a type="button" href="verify-buyer" class="btn btn-primary">
                                                Complete ID Verification to View Seller Contacts
                                            </a>
                                            <p>
                                                <span>
                                                    Being verified gives you the chance to view the property seller's
                                                    contact details.
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?
                            }
                            ?>
                            <hr/>
                            <h4>Selling</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="sell-your-property"  class="btn btn-primary">
                                            List a property
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        <h4>Edit Profile Details</h4>
						<div class="contact">
							<form id="edit-profile-form" name="form1" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="register-name">Name*</label>
											<input type="text" id="update-name" class="form-control" value="<?=$userDetails['name']?>" data-msg-required="Please enter your name" required>
										</div>
									</div>
								</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="register-phone">Phone Number*</label>
                                            <input type="text" id="update-phone" class="form-control" value="<?=$userDetails['phone_number']?>" data-msg-required="Please enter your phone" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="<?=$userDetails['user_id']?>" id="update-user">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6" id="update-error-message-div">
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
									<input type="submit" value="Update" onclick="updateUserDetails(event)" class="btn btn-primary min-wide" data-loading-text="Loading...">
								</div>
							</form>
						</div>
						
					</div>
                    <div class="col-md-9 content">
                        <h4>Edit Password</h4>
                        <div class="contact">
                            <form id="edit-password-form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="edit-old-password">Old Password*</label>
                                            <input type="password" id="edit-old-password" class="form-control" data-msg-required="Please enter your old password." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="edit-new-password">New Password*</label>
                                            <input type="password" id="edit-new-password" class="form-control" data-msg-required="Please enter new password."  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="edit-confirm-new-password">Confirm Password*</label>
                                            <input type="password" id="edit-confirm-new-password" class="form-control" data-msg-required="Please confirm your new password."  required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="<?=$userDetails['user_id']?>" id="update-user-id">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6" id="update-password-error-message-div">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Change Password" onclick="updatePassword(event)" class="btn btn-primary min-wide" data-loading-text="Loading...">
                                </div>
                            </form>
                        </div>
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
    <!--Form JS-->
	<script src="static/js/forms.js"></script>
	
</body>
</html>