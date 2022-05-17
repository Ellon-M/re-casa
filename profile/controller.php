<?php

use App\Processors\UserFunctions;

require 'app/vendor/autoload.php';

$userFunctions = new UserFunctions();
$userDetails = $userFunctions->fetchUserDetails($userID)["message"];
$buyerDetails = $userFunctions->listSingleBuyerDetails($userID)["message"];



