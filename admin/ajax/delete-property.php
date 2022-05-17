<?php
use App\Processors\UserFunctions;

require '../../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $propertyID = filter_input(INPUT_POST,"property_id",FILTER_SANITIZE_NUMBER_INT);

    if ($propertyID == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    } else{
        $userFunctions->deleteSellerDetails($propertyID);
        $userFunctions->deleteAllPropertyImages($propertyID,__DIR__."/../..");
        $response = $userFunctions->deleteProperty($propertyID);


        if ($response["error"] == "false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Successfully deleted</strong>
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