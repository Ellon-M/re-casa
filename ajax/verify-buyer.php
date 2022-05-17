<?php
use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);

    $idFile = $_FILES['id_file']['tmp_name'];
    $idFileName = $_FILES['id_file']['name'];
    $idFileSize = $_FILES['id_file']['size'];
    $idFileExtension = pathinfo($idFileName,PATHINFO_EXTENSION);

    $statementFile = $_FILES['statement_file']['tmp_name'];
    $statementFileName = $_FILES['statement_file']['name'];
    $statementFileSize = $_FILES['statement_file']['size'];
    $statementFileExtension = pathinfo($statementFileName,PATHINFO_EXTENSION);

    if ($userID == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }elseif (!in_array($idFileExtension,['jpeg','png','pdf','jpg']) || !in_array($statementFileExtension,['jpeg','png','pdf','jpg'])){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                <?php echo "This document file extension not accepted. Accepted file extensions: .jpeg, .png, .pdf, .jpg";?>
            </p></div>
        <?php
    }else if ($idFileSize > 10000000 || $statementFileSize > 10000000){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                <?php echo "File should not be more than 10MB";?></p></div>
        <?php
    }else{
        $baseDir = __DIR__."/..";

        $response = $userFunctions->uploadBuyerVerificationDocuments($userID,$baseDir,$idFile,$idFileName,$statementFile,$statementFileName);

        if ($response["error"] == "false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success! We shall contact you on your verification.</strong>
                </p></div>
<!--            <script id="results-ajax">-->
<!--                setTimeout(function(){-->
<!--                    document.querySelector(".alert-success").innerHTML = "";-->
<!--                }, 1000);-->
<!--            </script>-->
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