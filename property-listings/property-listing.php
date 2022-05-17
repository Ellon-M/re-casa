<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "templates/seo-header.php";?>

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
        <!--   Navigation header     -->
        <?php include "templates/navigation-bar.php";?>
        <!--   Navigation header     -->

		
		<!-- Begin Main -->
		<div role="main" class="main pgl-bg-grey">
			
			<!-- Begin Advanced Search -->
			<section class="pgl-advanced-search pgl-bg-light">
				<div class="container">
					<form>
						<div class="row">
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<label class="sr-only" for="property-status">Categories</label>
									<select id="ownership-type" name="ownership_type" data-placeholder="Ownership Type" class="chosen-select">
										<option selected="selected" value="<?=null?>">Categories</option>
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
									<select id="location" name="location" data-placeholder="Location" class="chosen-select">
										<option selected="selected" value="<?=null?>">Location</option>
										<?foreach ($locationsList as $location){
										    ?>
                                            <option value="<?=$location['location']?>"><?=$location['location']?></option>
                                            <?
                                        }?>
									</select>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<label class="sr-only" for="property_zone">Property Zoning</label>
									<select id="property-zone" name="zone" data-placeholder="Property Zones" class="chosen-select">
										<option selected="selected" value="<?=null?>">Property Zoning</option>
                                        <?foreach ($zonesList as $mZone){
                                            ?>
                                            <option value="<?=$mZone['zone']?>"><?=$mZone['zone']?></option>
                                            <?
                                        }?>
                                    </select>
								</div>
							</div>
						</div>
						<div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <label class="sr-only" for="area-from">Area From(acres)</label>
                                    <input type="number" id="area-from" name="acreage" placeholder="   Minimum Acreage">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3">
								<div class="form-group">
                                    <label class="sr-only" for="search-minprice">Minimum Price</label>
                                    <select id="search-minprice" name="value" data-placeholder="Minimum Price" class="chosen-select">
                                        <option selected="selected" value="<?=null?>">Minimum Price</option>
                                        <option value="10000">Ksh 10000</option>
                                        <option value="300000">Ksh 300000</option>
                                        <option value="500000">Ksh 500000</option>
                                        <option value="750000">Ksh 750000</option>
                                        <option value="1000000">Ksh 1000000</option>
                                        </option>
                                        <option value="1000000">Ksh 2000000</option>
                                    </select>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3">
								<div class="form-group">
									<button type="submit" class="btn btn-block btn-primary" >Find Property</button>
								</div>
							</div>
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <a href="sell-your-property" class="btn btn-block btn-primary">List Property</a>
                                </div>
							</div>
						</div>

					</form>
				</div>
			</section>
			<!-- End Advanced Search -->

            <?if($value == null && $acreage == null && $location == null && $zone == null && $ownershipType == null){
                ?>
                <!-- Begin Featured -->
                <section class="pgl-featured">
                    <div class="container">
                        <h2>Featured Properties</h2>
                        <div class="row">
                            <div class="owl-carousel pgl-pro-slide" data-plugin-options='{"items": 4, "singleItem": false, "autoPlay": false, "pagination": false}'>
                                <?foreach ($featuredProperties[0] as $property){
                                    ?>
                                    <div class="col-sm-12 animation">
                                        <div class="pgl-property featured-item">
                                            <div class="property-thumb-info">
                                                <div class="property-thumb-info-image">
                                                    <!--                                                TODO Handle image loading-->
<!--                                                    <img alt="" class="img-responsive" src="static/images/properties/property-featured-2.jpg">-->
                                                    <img class="img-responsive" src="<?=$images[$property['property_id']][0]?>" alt="<?=$property['title']?>" >
                                                </div>
                                                <div class="property-thumb-info-content">
                                                    <h3><a href="property-detail?post=<?=$property['property_id']?>"><?=$property['title']?></a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }?>
                            </div>
                        </div>
                        <hr class="top-tall">
                    </div>
                </section>
                <!-- End Featured -->
                <?
            }?>

			<!-- Begin Properties -->
			<section class="pgl-properties pgl-bg-grey">
				<div class="container">
					<h2 style="font-size:25px;">Search Results</h2>
					<div class="properties-full">
						<div id="top-all-properties" class="row">
                            <!--Loaded in js-->
						</div>
                        <div id="bottom-all-properties" class="row">
                            <!--Loaded in js-->
                        </div>
						<ul class="pagination">
                            <!--Loaded in js-->
					   </ul>
					</div>
				</div>
			</section>
			<!-- End Properties -->

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
    <script>
        let str = <?=json_encode($allPropertiesJson,JSON_UNESCAPED_LINE_TERMINATORS)?>;

        let value = JSON.parse(str);
        let images = JSON.parse('<?=$imagesJson?>');



    </script>
    <!--  Pagination  -->
	<script src="static/js/properties-pagination.js"></script>
    <!--  Advanced Search  -->
	<script src="static/js/advanced-search.js"></script>


</body>
</html>