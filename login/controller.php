<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();

$response = $userFunctions->listProperties(null,null,null,null,null,null,null)["message"];
$images = $userFunctions->listPropertyImages()["message"];

shuffle($response);
$featured = array_chunk($response,6);

shuffle($response);
$popular = array_chunk($response,6);