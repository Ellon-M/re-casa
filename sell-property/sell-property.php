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



    <!-- DropZone-->
    <link href="static/dropzone/dropzone.min.css" rel="stylesheet">

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
                    <h3><strong>Sell Property</strong></h3>
                    <h4><strong>Add Property Details</strong></h4>
                    <div class="contact">
                        <form id="sell-property-form" name="form1" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-name">Property Name*</label>
                                        <input type="text" id="property-name" class="form-control" data-msg-required="Please enter property name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-description">Property Description*</label>
                                        <textarea rows="9" id="property-description" class="form-control"
                                                  data-msg-required="Please enter the description of the property here" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-value">Property Value*</label>
                                        <input type="number" id="property-value" class="form-control" data-msg-required="Please enter the value of the property here" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-acreage">Acreage(acres)*</label>
                                        <input type="text" id="property-acreage" class="form-control" data-msg-required="Please enter property acreage here" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-location">Property Location*</label>
                                        <input type="text" id="property-location" class="form-control" data-msg-required="Please fill property location details" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-zone">Zone*</label>
                                        <select id="property-zone" data-placeholder="Property Zones" class="chosen-select" required>
                                            <option selected="selected" value="<?=null?>">Property Zone</option>
                                            <option value = "Industrial">Industrial</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Office">Office</option>
                                            <option value="Agricultural">Agricultural</option>
                                        </select>
                                    </div>
                                </div>
                            </div><div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="property-ownership-type">Ownership Type*</label>
                                        <select id="property-ownership-type" data-placeholder="Property Ownership Types" class="chosen-select" required>
                                            <option selected="selected" value="<?=null?>">Property Ownership Type</option>
                                            <option  value="Lease">Lease</option>
                                            <option value="Rent">Rent</option>
                                            <option  value="Buy">Buy</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dropzone" id="dropZone">
                                            Select two of the best images*
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="user-id" value="<?=$userID?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="property-error-message-div">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" onclick="validatePropertyInput()" id="submit-property" value="Submit" class="btn btn-primary min-wide" data-loading-text="Loading...">
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

<!-- Drop Zone -->
<script src="static/dropzone/dropzone.min.js"></script>

<script>
    let errorMessageDiv = document.getElementById("property-error-message-div");
    //property values
    let propertyName = document.getElementById("property-name");
    let propertyDescription = document.getElementById("property-description");
    let propertyValue = document.getElementById("property-value");
    let propertyAcreage = document.getElementById("property-acreage");
    let propertyLocation = document.getElementById("property-location");
    let propertyZone = document.getElementById("property-zone");
    let propertyOwnershipType = document.getElementById("property-ownership-type");
    let userID = document.getElementById("user-id");


    // disable autodiscover
    Dropzone.autoDiscover = false;


    var myDropzone = new Dropzone("#dropZone", {
        url: "ajax/upload-property.php",
        method: "POST",
        paramName: "file",
        autoProcessQueue : false,
        acceptedFiles: "image/*",
        maxFiles: 7,
        maxFilesize: 1.0, // MB
        uploadMultiple: true,
        parallelUploads: 100, // use it with uploadMultiple
        createImageThumbnails: true,
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        addRemoveLinks: true,
        timeout: 180000,
        dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file
        // Language Strings
        dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
        dictInvalidFileType: "Invalid File Type",
        dictCancelUpload: "Cancel",
        dictRemoveFile: "Remove",
        dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
        dictDefaultMessage: "Drop files here to upload",
    });

    // Add more data to send along with the file as POST data. (optional)
    myDropzone.on("sending", function(file, xhr, formData) {
        //send property data
        formData.append("property-name",propertyName.value);
        formData.append("property-description",propertyDescription.value);
        formData.append("property-value",propertyValue.value);
        formData.append("property-acreage",propertyAcreage.value);
        formData.append("property-location",propertyLocation.value);
        formData.append("property-zone",propertyZone.value);
        formData.append("property-ownership-type",propertyOwnershipType.value);
        formData.append("user-id",userID.value);
    });

    myDropzone.on("error", function(file, response) {
        console.log(response);
    });

    // on success
    myDropzone.on("successmultiple", function(file, response) {
        //TODO:Handle ajax response
        errorMessageDiv.innerHTML = "";
        errorMessageDiv.insertAdjacentHTML("beforeend", response);
        if (document.getElementById("results-ajax") !== null){
            eval(document.getElementById("results-ajax").innerHTML);
        }
    });

    // button trigger for processingQueue
    var submitDropzone = document.getElementById("submit-property");
    submitDropzone.addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();
        if (validatePropertyInput()){
            if (myDropzone.files !== "") {
                // console.log(myDropzone.files);
                myDropzone.processQueue();
            } else {
                // if no file submit the form
                document.getElementById("sell-property-form").submit();
            }
        }
    });


    function validatePropertyInput() {
        if (propertyName.value === "" ){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Property Name is required </p></div>";
            propertyName.style.borderColor = "red";
            propertyName.focus();
            return false;
        }else if(propertyDescription.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Property Description is required </p></div>";
            propertyDescription.style.borderColor = "red";
            propertyDescription.focus();
            return false;
        }else if(propertyAcreage.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Acreage is required</p></div>";
            propertyAcreage.style.borderColor = "red";
            propertyAcreage.focus();
            return false;
        }else if (propertyAcreage.value === 0){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Acreage value cannot be 0. In case of Office Space use N/A</p></div>";
            propertyAcreage.style.borderColor = "red";
            propertyAcreage.focus();
            return false;
        }else if (propertyOwnershipType.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Ownership Type needs to be defined</p></div>";
            propertyOwnershipType.style.borderColor = "red";
            propertyOwnershipType.focus();
            return false;
        }else if (propertyValue.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Value of the property is required</p></div>";
            propertyValue.style.borderColor = "red";
            propertyValue.focus();
            return false;
        }else if (propertyLocation.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Location of the property is required</p></div>";
            propertyLocation.style.borderColor = "red";
            propertyLocation.focus();
            return false;
        }else if (propertyZone.value === ""){
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Zone of the property is required</p></div>";
            propertyZone.style.borderColor = "red";
            propertyZone.focus();
            return false;
        }else if (userID.value === "") {
            //display error message
            errorMessageDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
                "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
                "                Fill in all the required fields </p></div>";
            return false;
        }else{
            return true;
        }
    }
</script>

</body>
</html>