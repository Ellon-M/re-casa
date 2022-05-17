<?php

use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
    $senderEmail = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    $senderSubject = filter_input(INPUT_POST,"subject",FILTER_SANITIZE_STRING);
    $senderMessage = filter_input(INPUT_POST,"message",FILTER_SANITIZE_STRING);

    if ($name == null || $name == false || $senderEmail == null || $senderEmail == false || $senderSubject == null ||
    $senderSubject == false || $senderMessage == null || $senderMessage == false){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        $output = $userFunctions->contactUsEmail($senderEmail,$senderMessage,$senderSubject,$name);
        if ($output['error'] == "false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success!</strong>
                </p></div>
            <script id="results-ajax">setTimeout(function(){ window.location.reload();}, 1000);</script>
            <?php
        }else{
            ?>
            <hr><div class="alert alert-danger"><p align="center"><strong>
                        <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                    <?php echo $output['message']?></p></div>
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
