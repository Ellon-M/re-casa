<?php

use App\Processors\UserFunctions;

require '../../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);
    $isConfirmedID = filter_input(INPUT_POST,"is_confirmed_id",FILTER_SANITIZE_NUMBER_INT);
    $isConfirmedTitle = filter_input(INPUT_POST,"is_confirmed_title",FILTER_SANITIZE_NUMBER_INT);
    $propertyID = filter_input(INPUT_POST,"property_id",FILTER_SANITIZE_NUMBER_INT);
    $userDetails = $userFunctions->fetchUserDetails($userID)["message"];

    if ($userID == false || $userID == null || $isConfirmedID == null || $isConfirmedTitle == null
        || $propertyID == null || $propertyID == false){

        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        if ($isConfirmedTitle == 0 || $isConfirmedID == 0){
            $response = array("error"=>"false","message"=>"deny");
        }else{
            $response = $userFunctions->addConfirmedSeller($userID,$isConfirmedID,$isConfirmedTitle,$propertyID);
        }


        if ($response["error"] == "false"){

            $userFunctions->deleteSellerVerificationDocuments($userID,__DIR__."/..");

            if ($response["message"] == "deny"){

                $rejectionMessage = "Hello ". $userDetails['name'] ."\nUnfortunately, the files you shared could not
                 help us to conclusively verify the property as your own. Kindly, have a look at them again then 
                 re-post the property for verification. Thank you for choosing Casavenida. Kind Regards.";
                $subject = "Property Verification";
                $userFunctions->sendEmail($userDetails['email'],$rejectionMessage,$subject);
            }else{
                $userFunctions->unhideProperty($propertyID);

                $acceptanceMessage = "Hello, ".$userDetails['name']." \n";
                $acceptanceMessage .= " The property you posted has been verified as your own and consequentially 
                listed. Thank you for choosing us.";
                $subject = "Property Verification";
                $userFunctions->sendEmail($userDetails['email'],$acceptanceMessage,$subject);
            }

            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success!</strong>
                </p></div>
            <?php
        }else{
            ?>
            <hr><div class="alert alert-danger"><p align="center"><strong>
                        <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                    <?php echo $response['message']?></p></div>
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