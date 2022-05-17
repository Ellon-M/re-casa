<?php

use App\Processors\UserFunctions;

require '../../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);
    $isConfirmedID = filter_input(INPUT_POST,"is_confirmed_id",FILTER_SANITIZE_NUMBER_INT);
    $isConfirmedBankStatement = filter_input(INPUT_POST,"is_confirmed_statement",FILTER_SANITIZE_NUMBER_INT);

    if ($userID == false || $userID == null || $isConfirmedID == null ||
        $isConfirmedBankStatement == null ){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        if ($isConfirmedID == 0 || $isConfirmedBankStatement == 0){
            $response = array("error"=>"false","message"=>"deny");
        }else{
            $response = $userFunctions->addConfirmedBuyer($userID,$isConfirmedID,$isConfirmedBankStatement);
        }

        if ($response["error"] == "false"){

            $userFunctions->deleteBuyerVerificationDocuments($userID,__DIR__."/..");

            if ($response["message"] == "deny"){
                
                $rejectionMessage = "Hello ". $userDetails['name'] ."\nUnfortunately, the files you shared could not
                 help us in your verifying you. Kindly, have a look at them again then re-submit for evaluation.
                  Thank you for choosing Casavenida. Kind Regards.";
                $subject = "Buyer Verification";
                $userFunctions->sendEmail($userDetails['email'],$rejectionMessage,$subject);
            }else{
           
                $acceptanceMessage = "Hello, ".$userDetails['name']." \n";
                $acceptanceMessage .= " The details you shared have been verified as your own and consequentially 
                you are now verified. Thank you for choosing us.";
                $subject = "Buyer Verification";
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