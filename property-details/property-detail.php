<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'templates/seo-header.php';?>

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
        <!--   Navigation Header     -->
        <?php include 'templates/navigation-bar.php'?>
        <!--   Navigation Header     -->
		
		<!-- Begin Main -->
		<div role="main" class="main pgl-bg-grey">
			
			<!-- Begin content with sidebar -->
			<div class="container">
				<div class="row">
					<div class="col-md-9 content">
						
						<section class="pgl-pro-detail pgl-bg-light">
							<div id="slider" class="flexslider">
								<ul class="slides">
                                    <?foreach ($images[$currentProperty['property_id']] as $image){
                                        ?>
                                        <li>
<!--                                           TODO Handle images-->
<!--                                            <img src="static/images/properties/property-detail-1.jpg" alt="">-->
                                            <img src="<?=$image?>" alt="<?=$currentProperty['title']?>">
                                            <span class="property-thumb-info-label">
											<span class="label price">Ksh <?=$currentProperty['value']?></span>
											<span class="label forrent"> <?=$currentProperty['ownership_type']?></span>
										</span>
                                        </li>
                                        <?
//                                        break;
                                    }?>
								</ul>
							</div>
							<div id="carousel" class="flexslider">
								<ul class="slides">
                                    <?foreach ($images[$currentProperty['property_id']] as $image){
                                        ?>
<!--                                        TODO Handle images-->
                                        <li> <img src="<?=$image?>" alt="<?=$currentProperty['description']?>"></li>
<!--                                        <li> <img src="static/images/properties/property-detail-s-1.jpg" alt=""></li>-->
                                        <?
//                                        break;
                                    }?>
								</ul>
							</div>
							<div class="pgl-detail">
								<div class="row">
									<div class="col-sm-4">
										<ul class="list-unstyled amenities amenities-detail">
											<li><strong>Type:</strong> <?=$currentProperty['ownership_type']?></li>
											<li><strong>Zoning:</strong> <?=$currentProperty['property_zone']?></li>
											<li><strong>Acreage:</strong> <?=$currentProperty['acreage']?><sup> acres</sup></li>
											<li><address><i class="icons icon-location"></i> <?=$currentProperty['location']?></address></li>
											<li><i class="fa fa-money"></i> Ksh: <?=$currentProperty['value']?></li>
										</ul>
									</div>
									<div class="col-sm-8">
										<h2><?=$currentProperty['title']?></h2>
                                        <span class="badge badge-primary"> Verified Direct Seller</span>
                                        <p><strong>Property Description</strong></p>
										<p><?=$currentProperty['description']?></p>
									</div>
								</div>

								<div class="tab-detail">
									<h3>More Infomation</h3>
									<div class="panel-group" id="accordion">
										<div class="panel panel-default pgl-panel">
											<div class="panel-heading">
												<h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseFouth" class="collapsed">Seller</a> </h4>
											</div>
											<div id="collapseFouth" class="panel-collapse collapse">
												<div class="panel-body">
													<div class="pgl-agent-item pgl-bg-light">
														<div class="row pgl-midnarrow-row">
															<div class="col-xs-4">
																<div class="img-thumbnail-medium">
																	<img alt="Property Seller" class="img-responsive" src="static/images/profile-icon.jpeg">
																</div>
															</div>
															<?if(isset($buyerDetails)){
															    ?>
                                                                <div class="col-xs-8">
                                                                    <div class="pgl-agent-info">
                                                                        <h4><?=$currentProperty['seller_name']?></h4>
                                                                        <address>
                                                                            <i class="fa fa-map-marker"></i> Phone : <?=$currentProperty['phone_number']?><br>
                                                                            <!--																		<i class="fa fa-phone"></i> Mobile : 0800-666-6666<br>-->
                                                                            <i class="fa fa-envelope-o"></i> Mail: <a href="mailto:<?=$currentProperty['email']?>"><?=$currentProperty['email']?></a>
                                                                        </address>
                                                                    </div>
                                                                </div>
                                                                <?
                                                            }else{
															    ?>
                                                                <div class="col-xs-8">
                                                                    <div class="pgl-agent-info">
                                                                        <h4>Verification</h4>
                                                                        <address>
                                                                            Sign in and complete ID verification to view seller contact details.
                                                
<!--                                                                            todo why get verified-->
                                                                        </address>
                                                                        <a class="btn btn-block btn-primary" href="verify-buyer">Get Verified</a>
                                                                    </div>
                                                                </div>
                                                                <?
                                                            }?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						
						<!-- Begin Related properties -->
						<section class="pgl-properties">
							<h2>Related Properties</h2>
							<div class="row">
								<div class="owl-carousel pgl-pro-slide" data-plugin-options='{"items": 3, "itemsDesktop": 3, "singleItem": false, "autoPlay": false, "pagination": false}'>
                                    <?foreach ($relatedProperties[0] as $property){
                                        ?>
                                        <div class="col-md-12 animation">
                                            <div class="pgl-property">
                                                <div class="property-thumb-info">
                                                    <div class="property-thumb-info-image">
<!--                                                        TODO Handle image loading-->
                                                        <img class="img-responsive" src="<?=$images[$property['property_id']][0]?>" alt="<?=$property['description']?>" >
<!--                                                        <img alt="" class="img-responsive" src="static/images/properties/property-1.jpg">-->
                                                        <span class="property-thumb-info-label">
														<span class="label price"> Ksh <?=$property['value']?></span>
														<span class="label forrent"><?=$property['ownership_type']?></span>
													</span>
                                                    </div>
                                                    <div class="property-thumb-info-content">
                                                        <h3><a href="property-detail?post=<?=$property['property_id']?>"><?=$property['title']?></a></h3>
                                                        <address><?=$property['location']?></address>
                                                        <span class="badge badge-primary"> Verified Direct Seller</span>
                                                    </div>
                                                    <div class="amenities clearfix">
                                                        <ul class="pull-left">
                                                            <li><strong>Acreage:</strong> <?=$property['acreage']?><sup> acres</sup></li>
                                                        </ul>
                                                        <ul class="pull-right">

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                    }?>
								</div>
							</div>
						</section>
						<!-- End Related properties -->
						
					</div>
					<div class="col-md-3 sidebar">

						<!-- Begin Advanced Search -->
						<aside class="block pgl-advanced-search pgl-bg-light">
							<h3>Advance Search</h3>
							<form name="advancedsearch">
								<div class="form-group">
									<label class="sr-only" for="ownership-type">Ownership Type</label>
									<select id="ownership-type" name="ownership_type" data-placeholder="Ownership Type" class="chosen-select">
										<option selected="selected" value="<?=null?>">Categories</option>
                                        <?foreach ($ownershipTypeList as $res){
                                            ?>
                                            <option value="<?=$res['ownership_type']?>"><?=$res['ownership_type']?></option>
                                            <?
                                        }?>
									</select>
								</div>
								<div class="form-group">
									<label class="sr-only" for="location">Location</label>
									<select id="location" name="location" data-placeholder="Location" class="chosen-select">
										<option selected="selected" value="<?=null?>">Location</option>
                                        <?foreach ($locationsList as $res){
                                            ?>
                                            <option value="<?=$res['location']?>"><?=$res['location']?></option>
                                            <?
                                        }?>

									</select>
								</div>
								<div class="form-group">
									<label class="sr-only" for="property-zone">Zoning</label>
									<select id="property-zone" name="zone" data-placeholder="Property Zone" class="chosen-select">
										<option selected="selected" value="<?=null?>">Zoning</option>
                                        <?foreach ($zonesList as $res){
                                            ?>
                                            <option value="<?=$res['zone']?>"><?=$res['zone']?></option>
                                            <?
                                        }?>
									</select>
								</div>
								<div class="form-group">
									<label class="sr-only" for="area-from">   Minimum Acreage</label>
                                    <input type="number" id="area-from" name="acreage" placeholder="   Minimum Acreage">
								</div>
								<div class="form-group">
                                    <label class="sr-only" for="search-minprice">Price From</label>
                                    <select id="search-minprice" name="search-minprice" data-placeholder="Price From" class="chosen-select">
                                        <option selected="selected" value="<?=null?>">Price From</option>
                                        <option value="0">Ksh 0</option>
                                        <option value="25000">Ksh 25000</option>
                                        <option value="50000">Ksh 50000</option>
                                        <option value="75000">Ksh 75000</option>
                                        <option value="100000">Ksh 100000</option>
                                        <option value="150000">Ksh 150000</option>
                                        <option value="200000">Ksh 200000</option>
                                        <option value="300000">Ksh 300000</option>
                                        <option value="500000">Ksh 500000</option>
                                        <option value="750000">Ksh 750000</option>
                                        <option value="1000000">Ksh 1000000</option>
                                    </select>
								</div>
								<div class="form-group">
									<button class="btn btn-block btn-primary" onclick="searchProperties(event)">Find your home</button>
								</div>
                                <div class="form-group">
									<a href="sell-your-property" class="btn btn-block btn-primary">List Property</a>
								</div>
								
							</form>
						</aside>
						<!-- End Advanced Search -->


					</div>
				</div>	
			</div>
			<!-- End content with sidebar -->
			
		</div>
		<!-- End Main -->
		
		<!-- Begin footer -->
		<?php include 'templates/page-footer.php'?>
		<!-- End footer -->
			
	</div>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="static/vendor/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="static/bootstrap/js/bootstrap.min.js"></script>
	<script src="static/vendor/owl-carousel/owl.carousel.js"></script>
	<script src="static/vendor/flexslider/jquery.flexslider-min.js"></script>
	<script src="static/vendor/chosen/chosen.jquery.min.js"></script>
	<script src="static/vendor/masonry/imagesloaded.pkgd.min.js"></script>
	<script src="static/vendor/masonry/masonry.pkgd.min.js"></script>
	
	<!-- Theme Initializer -->
	<script src="static/js/theme.plugins.js"></script>
	<script src="static/js/theme.js"></script>
    <!--Advanced Search-->
    <script src="static/js/advanced-search.js"></script>
</body>
</html>