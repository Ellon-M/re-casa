<?php

use App\Processors\UserFunctions;

require '../../app/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);

    if ($email == null || $email == false || $password == null || $password == false){

        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        $response = $userFunctions->loginAdmin($email,$password);

        if ($response["error"] == "false"){
            session_start();
            $_SESSION['admin'] = $response['message'];

            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success!</strong>
                </p></div>
            <script id="results-ajax">setTimeout(function(){ window.location.replace('home');}, 1000);</script>
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