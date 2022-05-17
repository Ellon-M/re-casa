<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'templates/seo-header.php'?>

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
						<h3><strong>Login</strong></h3>
						<div class="contact">
							<form name="form1" method="post">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label for="user-email">Email*</label>
											<input type="email" id="user-email" class="form-control" data-msg-required="Please enter your email" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
                                        <div class="col-sm-6">
                                            <label for="user-password">Password*</label>
                                            <input type="password" id="user-password" class="form-control" data-msg-required="Please enter your password." required>
                                        </div>
									</div>
								</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6" id="login-response">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="register">Register Account</a>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
									<input type="submit" value="Submit" class="btn btn-primary min-wide" onclick="login(event)" data-loading-text="Loading...">
								</div>
							</form>
						</div>
						
					</div>
					<div class="col-md-3 sidebar">

                        <!-- Begin Tabs -->
                        <aside class="block tabs pgl-bg-light">
                            <ul class="nav nav-tabs second-tabs">
                                <li class="active"><a href="#popularProperties" data-toggle="tab"><i class="icon icon-star"></i> Popular</a></li>
                                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="popularProperties">
                                    <ul class="list-unstyled simple-post-list">
                                        <?php
                                        foreach ($popular[0] as $property){
                                            ?>
                                            <li>
                                                <div class="post-image">
                                                    <!--TODO:Image Paths-->
<!--                                                    <a href="property-detail?post=--><?//=$property['property_id']?><!--"><img class="img-responsive" src="static/images/blog/demo-thumb-7.jpg" alt="--><?//=$property['description']?><!--"></a>-->
                                                    <a href="property-detail?post=<?=$property['property_id']?>"><img class="img-responsive" src="<?=$images[$property['property_id']][0]?>" alt="<?=$property['description']?>"></a>
                                                </div>
                                                <div class="post-info">
                                                    <a href="property-detail?post=<?=$property['property_id']?>"><?=$property['title']?></a>
                                                    <div class="post-meta">
                                                        <i class="fa fa-money"></i> Ksh <?=$property["value"]?>
                                                    </div>
                                                </div>
                                            </li>
                                            <?
                                        }?>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="featured">
                                    <ul class="list-unstyled simple-post-list">
                                        <?php
                                        foreach ($featured[0] as $property){
                                            ?>
                                            <li>
                                                <div class="post-image">
                                                    <!--TODO:Image Paths-->
                                                    <a href="property-detail?post=<?=$property['property_id']?>"><img class="img-responsive" src="<?=$images[$property['property_id']][0]?>" alt="<?=$property['description']?>"></a>
<!--                                                    <a href="property-detail?post=--><?//=$property['property_id']?><!--"><img class="img-responsive" src="static/images/blog/demo-thumb-1.jpg" alt="--><?//=$property['description']?><!--"></a>-->
                                                </div>
                                                <div class="post-info">
                                                    <a href="property-detail?post=<?=$property['property_id']?>"><?=$property['title']?></a>
                                                    <div class="post-meta">
                                                        <i class="fa fa-money"></i> Ksh <?=$property['value']?>
                                                    </div>
                                                </div>
                                            </li>
                                            <?
                                        }?>

                                    </ul>
                                </div>
                            </div>
                        </aside>
                        <!-- End Tabs -->
						
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

    <!--Form-->
    <script src="static/js/forms.js"></script>
	
</body>
</html>