<?php
use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);
    $propertyID = filter_input(INPUT_POST,"property_id",FILTER_SANITIZE_NUMBER_INT);

    $idFile = $_FILES['id_file']['tmp_name'];
    $idFileName = $_FILES['id_file']['name'];
    $idFileSize = $_FILES['id_file']['size'];
    $idFileExtension = pathinfo($idFileName,PATHINFO_EXTENSION);

    $titleFile = $_FILES['seller_title']['tmp_name'];
    $titleFileName = $_FILES['seller_title']['name'];
    $titleFileSize = $_FILES['seller_title']['size'];
    $titleFileExtension = pathinfo($titleFileName,PATHINFO_EXTENSION);

    $transactionCode = filter_input(INPUT_POST,"transaction_code",FILTER_SANITIZE_STRING);

    if ($userID == null || $propertyID == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    } elseif ($transactionCode == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide transaction code</p></div>
        <?php
    }elseif (!in_array($idFileExtension,['jpeg','png','pdf','jpg']) || !in_array($titleFileExtension,['jpeg','png','pdf','jpg'])){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                <?php echo "This document file extension not accepted. Accepted file extensions: .jpeg, .png, .pdf, .jpg";?>
            </p></div>
        <?php
    }else if ($idFileSize > 10000000 || $titleFileSize > 10000000){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                <?php echo "File should not be more than 10MB";?></p></div>
        <?php
    }else{
        $baseDir = __DIR__."/..";

        $response = $userFunctions->uploadSellerVerificationDocuments($userID,$baseDir,$idFile,$idFileName,$titleFile,
            $titleFileName,$propertyID,$transactionCode);
        if ($response["error"] == "false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success! We shall contact you on your verification.</strong>
                </p></div>
<!--                        <script id="results-ajax">-->
<!--                            setTimeout(function(){-->
<!--                                window.location.replace("verify-seller")-->
<!--                            }, 1000);-->
<!--                        </script>-->
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