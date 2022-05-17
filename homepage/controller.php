<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

$response = $userFunctions->listProperties(null,null,null,null,null,null,null)["message"];
$images = $userFunctions->listPropertyImages()["message"];

shuffle($response);
$popular = array_chunk($response,3);
shuffle($response);
$featured = array_chunk($response,3);
shuffle($response);
$todaySpecial = array_chunk($response,3);
shuffle($response);
$topFive = array_chunk($response,4);
shuffle($response);
$sliderContent = array_chunk($response,3);
//slider items
$propertyOne = $sliderContent[0][0];
$propertyTwo = $sliderContent[0][1];
$propertyThree = $sliderContent[0][2];

//fetch unique locations
$locationsList = $userFunctions->listUniqueLocations()["message"];
//fetch unique zones
$zonesList = $userFunctions->listUniqueZones()["message"];
//fetch distinct ownership types
$ownershipTypeList = $userFunctions->listUniqueOwnershipTypes()["message"];



