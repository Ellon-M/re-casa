<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

//get advanced search variables from url
//value,acreage,ownershipType,zone,location
$value = filter_input(INPUT_GET,"value",FILTER_SANITIZE_NUMBER_FLOAT);
$acreage = filter_input(INPUT_GET,"acreage",FILTER_SANITIZE_NUMBER_FLOAT);
$location = filter_input(INPUT_GET,"location",FILTER_SANITIZE_STRING);
$zone = filter_input(INPUT_GET,"zone",FILTER_SANITIZE_STRING);
$ownershipType = filter_input(INPUT_GET,"ownership_type",FILTER_SANITIZE_STRING);

//fetch all properties
$response = $userFunctions->listProperties($value,$acreage,$location,$zone,$ownershipType,null,null)["message"];

//fetch unique locations
$locationsList = $userFunctions->listUniqueLocations()["message"];
$zonesList = $userFunctions->listUniqueZones()["message"];
$ownershipTypeList = $userFunctions->listUniqueOwnershipTypes()["message"];

//fetch all images
$images = $userFunctions->listPropertyImages()["message"];
$imagesJson = json_encode($images);

//json encode all properties array
$allProperties = $response;
$allPropertiesJson = json_encode($allProperties);

//create featured properties array
shuffle($response);
$featuredProperties = array_chunk($response,6);


