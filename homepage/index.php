<!DOCTYPE html>
<html lang="en">
<head>
    <!--  SEO  -->
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
        <!--	Header	-->
        <?php include_once 'templates/navigation-bar.php' ?>
        <!--	Header	-->
		
		<!-- Begin Main -->
		<div role="main" class="main">
			<!-- Begin Main Slide -->
			<section class="main-slide">
				<div id="owl-main-slide" class="owl-carousel pgl-main-slide" data-plugin-options='{"autoPlay": true}'>
					<div class="item" id="item1">
<!--                        TODO handle images-->
<!--                        <img src="--><?//=$images[$propertyOne['property_id']][0]?><!--" alt="--><?//=$propertyOne['description']?><!--" class="img-responsive">-->
                        <img src="static/images/slides/slider1.jpg" alt="<?=$propertyOne['description']?>" class="img-responsive">
						<div class="item-caption">
							<div class="container">
								<div class="property-info">
									<span class="property-thumb-info-label">
										<span class="label price"> Ksh <?=$propertyOne['value']?></span>
										<span class="label"><a href="property-detail?<?=urlencode('post='.$propertyOne['property_id'])?>" class="btn-more">More Detail</a></span>
									</span>
									<div class="property-thumb-info-content">
										<h2><a href="property-detail?<?=urlencode('post='.$propertyOne['property_id'])?>"><?=$propertyOne['title']?></a></h2>
										<p><?=$propertyOne['description']?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item" id="item2"><img src="static/images/slides/slider2.jpg" alt="Photo" class="img-responsive">
<!--                        TODO Handle images-->
<!--					<div class="item" id="item2"><img src="--><?//=$images[$propertyTwo['property_id']][0]?><!--" alt="--><?//=$propertyTwo['description']?><!--" class="img-responsive">-->
						<div class="item-caption">
							<div class="container">
								<div class="property-info">
									<span class="property-thumb-info-label">
										<span class="label price"> Ksh <?=$propertyTwo['value']?></span>
										<span class="label"><a href="property-detail?<?=urlencode('post='.$propertyTwo['property_id'])?>" class="btn-more">More Detail</a></span>
									</span>
									<div class="property-thumb-info-content">
										<h2><a href="property-detail?<?=urlencode('post='.$propertyTwo['property_id'])?>"><?=$propertyTwo['title']?></a></h2>
										<p><?=$propertyTwo['description']?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item" id="item3">
                        <img src="static/images/slides/slider3.jpg" alt="Photo" class="img-responsive">
<!--                        <img src="--><?//=$images[$propertyThree['property_id']][0]?><!--" alt="--><?//=$propertyThree['description']?><!--" class="img-responsive">-->
						<div class="item-caption">
							<div class="container">
								<div class="property-info">
									<span class="property-thumb-info-label">
										<span class="label price"> Ksh <?=$propertyThree['value']?></span>
										<span class="label"><a href="property-detail?<?=urlencode('post='.$propertyThree['property_id'])?>" class="btn-more">More Detail</a></span>
									</span>
									<div class="property-thumb-info-content">
										<h2><a href="property-detail?<?=urlencode('post='.$propertyThree['property_id'])?>"><?=$propertyThree['title']?></a></h2>
										<p><?=$propertyThree['description']?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Main Slide -->
			
			<!-- Begin Advanced Search -->
			<section class="pgl-advanced-search pgl-bg-light">
				<div class="container">
					<form name="advancedsearch">
						<div class="row">
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<label class="sr-only" for="ownership-type">Categories</label>
									<select id="ownership-type" name="ownership_type" data-placeholder="Ownership Type" class="chosen-select" tabindex="1">
										<option selected="selected" value="<?=null?>">Ownership Type</option>
                                        <?foreach ($ownershipTypeList as $res){
                                            ?>
                                            <option value="<?=$res['ownership_type']?>"><?=$res['ownership_type']?></option>
                                            <?
                                        }?>
									</select>
								</div>
							</div>	
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<label class="sr-only" for="location">Location</label>
									<select id="location" name="location" data-placeholder="Location" class="chosen-select" tabindex="2">
										<option selected="selected" value="<?=null?>">Location</option>
                                        <?foreach ($locationsList as $res){
                                            ?>
                                            <option value="<?=$res['location']?>"><?=$res['location']?></option>
                                            <?
                                        }?>
									</select>
								</div>
							</div>
							
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<label class="sr-only" for="property-zone">Property Zone</label>
									<select id="property-zone" name="zone" data-placeholder="Property Zones" class="chosen-select" tabindex="3">
										<option selected="selected" value="<?=null?>">Property Zones</option>
                                        <?foreach ($zonesList as $res){
                                            ?>
                                            <option value="<?=$res['zone']?>"><?=$res['zone']?></option>
                                            <?
                                        }?>
									</select>
								</div>
							</div>	

						</div>
						
						<div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <label class="sr-only" for="area-from">Area From (Acres)</label>
                                    <input type="number" id="area-from" name="acreage" placeholder="Minimum Acreage">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <label class="sr-only" for="search-minprice">Price From</label>
                                    <select id="search-minprice" name="value" data-placeholder="Minimum Price" class="chosen-select">
                                        <option selected="selected" value="<?=null?>">Minimum Price</option>
                                        <option value="10000">Ksh 10000</option>
                                        <option value="300000">Ksh 300000</option>
                                        <option value="500000">Ksh 500000</option>
                                        <option value="750000">Ksh 750000</option>
                                        <option value="1000000">Ksh 1000000</option>
                                    </select>
                                </div>
                            </div>

							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<button class="btn btn-block btn-primary" onclick="searchProperties(event)">Find Property</button>
								</div>
                                <div class="form-group">
                                    <a href="sell-your-property" class="btn btn-block btn-primary">List Property</a>
                                </div>
							</div>	
						</div>
						
					</form>
				</div>
			</section>
			<!-- End Advanced Search -->
			
			<!-- Begin Featured -->
			<section class="pgl-featured pgl-bg-grey">
				<div class="container">
					<div class="row">
                        <?foreach ($topFive[0] as $property){
                            ?>
                            <div class="col-md-6 animation">
                                <div class="pgl-property featured-item">
                                    <div class="property-thumb-info">
                                        <div class="property-thumb-info-image">
<!--                                            TODO: Handle IMages-->
<!--                                            <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--">-->
                                            <img alt="" class="img-responsive" src="static/images/properties/property-featured-1.jpg">
                                        </div>
                                        <div class="property-thumb-info-content">
                                            <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['location']?></a></h3>
                                            <p><?=$property['title']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                            break;
                        }
                        foreach ($topFive[1] as $property){
                            ?>
                            <div class="col-xs-6 col-md-3 animation">
                                <div class="pgl-property featured-item">
                                    <div class="property-thumb-info">
                                        <div class="property-thumb-info-image">
                                            <!--                                            TODO: Handle IMages-->
<!--                                            <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--">-->
                                            <img alt="" class="img-responsive" src="static/images/properties/property-featured-2.jpg">
                                        </div>
                                        <div class="property-thumb-info-content">
                                            <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['location']?></a></h3>
                                            <p><?=$property['title']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                        }?>
					</div>
					<hr class="top-tall">
				</div>
			</section>
			<!-- End Featured -->
			
			<!-- Begin Properties -->
			<section class="pgl-properties pgl-bg-grey">
				<div class="container">
					<h2>Properties</h2>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs pgl-pro-tabs text-center animation" role="tablist">
						<li class="active"><a href="#popular" role="tab" data-toggle="tab">Popular</a></li>
						<li><a href="#featured" role="tab" data-toggle="tab">Featured</a></li>
						<li><a href="#today-special" role="tab" data-toggle="tab">Today's Special</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="popular">
							<div class="row">
                                <?php
                                foreach ($popular[0] as $property){
                                    ?>
                                    <div class="col-xs-4 animation">
                                        <div class="pgl-property">
                                            <div class="property-thumb-info">
                                                <div class="property-thumb-info-image">
<!--                                                    TODO Handle images-->
<!--                                                    <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--" >-->
                                                    <img alt="" class="img-responsive" src="static/images/properties/property-4.jpg">
                                                    <span class="property-thumb-info-label">
													<span class="label price"> Ksh <?=$property['value']?></span>
													<span class="label forrent"><?$property['ownership_type']?></span>
												</span>
                                                </div>
                                                <div class="property-thumb-info-content">
                                                    <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['title']?></a></h3>
                                                    <address><?=$property['location']?></address>
                                                </div>
                                                <div class="amenities clearfix">
                                                    <ul class="pull-left">
                                                        <li><strong>Area:</strong> <?=$property['acreage']?><sup> acres</sup></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }
                                ?>
							</div>
							<div class="row">
                                <?foreach ($popular[1] as $property){
                                    ?>
                                    <div class="col-xs-4 animation">
                                        <div class="pgl-property">
                                            <div class="property-thumb-info">
                                                <div class="property-thumb-info-image">
                                                    <!--TODO: Handle images-->
<!--                                                    <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--" >-->
                                                    <img alt="" class="img-responsive" src="static/images/properties/property-4.jpg">
                                                    <span class="property-thumb-info-label">
													<span class="label price"> Ksh <?=$property['value']?></span>
													<span class="label forrent"><?=$property['ownership_type']?></span>
												</span>
                                                </div>
                                                <div class="property-thumb-info-content">
                                                    <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['title']?></a></h3>
                                                    <address><?=$property['location']?></address>
                                                </div>
                                                <div class="amenities clearfix">
                                                    <ul class="pull-left">
                                                        <li><strong>Area:</strong> <?=$property['acreage']?><sup> acres</sup></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }?>
							</div>
						</div>
						<div class="tab-pane" id="featured">
							<div class="row">
                                <?foreach ($featured[0] as $property){
                                    ?>
                                    <div class="col-xs-4 animation">
                                        <div class="pgl-property">
                                            <div class="property-thumb-info">
                                                <div class="property-thumb-info-image">
                                                    <!--TODO: Handle images-->
                                                    <!--                                                    <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--" >-->
                                                    <img alt="" class="img-responsive" src="static/images/properties/property-4.jpg">
                                                    <span class="property-thumb-info-label">
													<span class="label price"> Ksh <?=$property['value']?></span>
													<span class="label forrent"><?=$property['ownership_type']?></span>
												</span>
                                                </div>
                                                <div class="property-thumb-info-content">
                                                    <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['title']?></a></h3>
                                                    <address><?=$property['location']?></address>
                                                </div>
                                                <div class="amenities clearfix">
                                                    <ul class="pull-left">
                                                        <li><strong>Area:</strong> <?=$property['acreage']?><sup> acres</sup></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }?>
							</div>
						</div>
						<div class="tab-pane" id="today-special">
							<div class="row">
                                <?foreach ($todaySpecial[0] as $property){
                                    ?>
                                    <div class="col-xs-4 animation">
                                        <div class="pgl-property">
                                            <div class="property-thumb-info">
                                                <div class="property-thumb-info-image">
                                                    <!--TODO: Handle images-->
                                                    <!--                                                    <img class="img-responsive" src="--><?//=$images[$property['property_id']][0]?><!--" alt="--><?//=$property['description']?><!--" >-->
                                                    <img alt="" class="img-responsive" src="static/images/properties/property-4.jpg">
                                                    <span class="property-thumb-info-label">
													<span class="label price"> Ksh <?=$property['value']?></span>
													<span class="label forrent"><?=$property['ownership_type']?></span>
												</span>
                                                </div>
                                                <div class="property-thumb-info-content">
                                                    <h3><a href="property-detail?<?=urlencode('post='.$property['property_id'])?>"><?=$property['title']?></a></h3>
                                                    <address><?=$property['location']?></address>
                                                </div>
                                                <div class="amenities clearfix">
                                                    <ul class="pull-left">
                                                        <li><strong>Area:</strong> <?=$property['acreage']?><sup> acres</sup></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }?>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- End Properties -->
			
			<!-- Begin About -->
			<section class="pgl-about">
				<div class="container">
					<div class="row">
						<div class="col-md-4 animation about-item">
							<h2>Who We Are</h2>
							<p><img src="static/images/casavenida_logo.jpg" alt="" class="img-responsive"></p>
							<p>Casavenida.com is a lead generation and prospecting platform for verified direct buyers and direct sellers of residential and rental real estate </p>
							<a href="about-us" class="btn btn-lg btn-default">View more</a>
						</div>
						<div class="col-md-4 animation about-item">
							<h2>Why Choose Us</h2>
							<div class="panel-group" id="accordion">
								<div class="panel panel-default pgl-panel">
									<div class="panel-heading">
										<h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Designed for your business</a> </h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body"> 
											<p>A lead generation and prospecting platform for verified direct buyers and direct sellers of residential and rental real estate </p>
										</div>
									</div>
								</div>
								<div class="panel panel-default pgl-panel">
									<div class="panel-heading">
										<h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">Easily Accessible</a> </h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body"> <p>You can comfortably access our services from the comfort of your phone or tablet.</p> </div>
									</div>
								</div>
								<div class="panel panel-default pgl-panel">
									<div class="panel-heading">
										<h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Confidentiality of data</a> </h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											<p>We handle your data with a lot of confidentiality. Verification documents shared with us are deleted completely and immediately after verification is done.</p>
										</div>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</section>
			<!-- End About -->
			
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

	<script src="static/vendor/masonry/imagesloaded.pkgd.min.js"></script>
	<script src="static/vendor/masonry/masonry.pkgd.min.js"></script>
	
	<!-- Theme Initializer -->
	<script src="static/js/theme.plugins.js"></script>
	<script src="static/js/theme.js"></script>
    <!--  Advanced Search  -->
	<script src="static/js/advanced-search.js"></script>

</body>
</html>