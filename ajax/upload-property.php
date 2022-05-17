<?php

use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $propertyName = filter_input(INPUT_POST,"property-name",FILTER_SANITIZE_STRING);
    $propertyDescription = filter_input(INPUT_POST,"property-description",FILTER_SANITIZE_STRING);
    $propertyValue = filter_input(INPUT_POST,"property-value",FILTER_SANITIZE_NUMBER_INT);
    $propertyAcreage = filter_input(INPUT_POST,"property-acreage",FILTER_SANITIZE_STRING);
    $propertyLocation = filter_input(INPUT_POST,"property-location",FILTER_SANITIZE_STRING);
    $propertyZone = filter_input(INPUT_POST,"property-zone",FILTER_SANITIZE_STRING);
    $propertyOwnershipType = filter_input(INPUT_POST,"property-ownership-type",FILTER_SANITIZE_STRING);
    $userID = filter_input(INPUT_POST,"user-id",FILTER_SANITIZE_NUMBER_INT);


    $baseDir =__DIR__."/..";

    foreach($_FILES['file']['tmp_name'] as $key => $value) {
        $imageTempFiles[] = $_FILES['file']['tmp_name'][$key];
        $imageFileNames[] =  $_FILES['file']['name'][$key];
    }

    if ($propertyName == null || $propertyName == false || $propertyDescription == null || $propertyDescription == false ||
     $propertyValue == null || $propertyValue == false || $propertyAcreage == null || $propertyAcreage == false ||
     $propertyLocation == null || $propertyLocation == false || $propertyZone == null || $propertyZone == false ||
     $propertyOwnershipType == null || $propertyOwnershipType == false || $userID == false || $userID == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        $response = $userFunctions->addProperty($propertyName,$propertyDescription,$propertyValue,$propertyAcreage,$propertyLocation,
            1,$propertyZone,$propertyOwnershipType,$userID,$imageTempFiles,$imageFileNames,$baseDir);
        if ($response["error"]="false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success!</strong>
                </p></div>
<!--            <script id="results-ajax">setTimeout(function(){ window.location.replace("verify-seller")}, 1000);</script>-->
            <script id="results-ajax">setTimeout(function(){
                window.location.replace("<?="verify-seller?property=".$response['message']?>")}, 1000);</script>
            <?php
        }else{
            ?>
            <hr><div class="alert alert-danger"><p align="center"><strong>
                        <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                    Ooops! Something went wrong. Try Again</p></div>
            <?php
        }
    }
}else{
    ?>
    <hr><div class="alert alert-danger"><p align="center"><strong>
                <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
            Ooops! Something went wrong</p></div>
    <?php
}