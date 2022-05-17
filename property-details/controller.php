<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

$postID = filter_input(INPUT_GET,"post",FILTER_SANITIZE_NUMBER_INT);

$currentProperty = $userFunctions->listProperties(null,null,null,null,null,null,$postID)["message"][0];
$response = $userFunctions->listProperties(null,null,null,null,null,null,null)["message"];
$images = $userFunctions->listPropertyImages()["message"];


shuffle($response);
$relatedProperties = array_chunk($response,4);

//fetch unique locations
$locationsList = $userFunctions->listUniqueLocations()["message"];
$zonesList = $userFunctions->listUniqueZones()["message"];
$ownershipTypeList = $userFunctions->listUniqueOwnershipTypes()["message"];

//whether user is verified
$buyerDetails = $userFunctions->listSingleBuyerDetails($userID)["message"];