<?php

use App\Processors\UserFunctions;

require "app/vendor/autoload.php";

$faker = Faker\Factory::create();
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\Lorem($faker));
$faker->addProvider(new Faker\Provider\Internet($faker));

$userFunctions = new UserFunctions();

/**fake user additions**/
//for ($i = 0;$i < 30;$i++){
//    $userFunctions->registerUser($faker->name,$faker->email,$faker->phoneNumber,$faker->password(8,20));
//}

/**fake property additions**/
//$zone = array("Industrial","Commercial","Institutional","Public","Private");
//$ownershipType = array("Lease","Rental","Hire","Buy");
//$imagesTempName = array("/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png",
//    "/home/m3n/Pictures/Screenshot from 2020-12-08 06-47-18.png");
//$imagesFileName = array("Image 1","Image 1","Image 1","Image 1",
//    "Image 1","Image 1","Image 1","Image 1","Image 1","Image 1",
//    "Image 1","Image 1","Image 1","Image 1","Image 1");
//
//for ($i = 0;$i < 30;$i++){
//    $output = $userFunctions->addProperty($faker->text(40),$faker->text(),$faker->numberBetween(1000,1000000),
//        $faker->randomNumber(),$faker->locale,1,$zone[array_rand($zone)],$ownershipType[array_rand($ownershipType)],
//        random_int(1,30),$imagesTempName,$imagesFileName,__DIR__);
//    echo $output["message"];
//}
/**fake buyers additions**/
//$counter = 1;
//for ($i = 0;$i < 30;$i++){
//    $userFunctions->addConfirmedBuyer($counter,true,true);
//    $counter++;
//}

/**fake seller additions**/
//$counter = 1;
//for ($i = 0;$i < 30;$i++){
//    $userFunctions->addConfirmedSeller($counter,true,true,random_int(1,180));
//    $counter++;
//}

/**fake seller additions**/
//$counter = 1;
//for ($i = 0;$i < 30;$i++){
//    $userFunctions->uploadSellerVerificationDocuments($counter,__DIR__,
//        "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png","Image ID",
//        "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png","ImageTitleDeed",
//        random_int(1,180));
//    $counter += 2;
//}

/**fake buyer additions**/
//$counter = 15;
//for ($i = 0;$i < 40;$i++){
//    if (($counter % 2) == 0){
//        $userFunctions->uploadBuyerVerificationDocuments($counter,__DIR__,
//            "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png","Image ID",
//            "/home/m3n/Pictures/Screenshot from 2021-01-12 10-57-03.png","ImageTitleDeed");
//    }
//    $counter += 1;
//}

//echo $userFunctions->registerAdmin("Windsor","dundafuta@gmail.com","crew890qivds");

