<?php

use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST,"phone_number",FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);

    if ($email == false || $email == null || $password == false || $password == null || $name == null || $name == false
    || $phoneNumber == false || $phoneNumber == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
//        $output = $userFunctions->loginUser($email,$password);
        $output = $userFunctions->registerUser($name,$email,$phoneNumber,$password);

        if ($output['error'] == "false"){
            ?>
            <hr><div class="alert alert-success"><p align="center"><strong>
                        <i class="fa info"></i> Success!</strong>
                </p></div>
            <script id="results-ajax">setTimeout(function(){ window.location.replace('log-in');}, 1000);</script>
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
