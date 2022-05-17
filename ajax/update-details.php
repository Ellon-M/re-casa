<?php

use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);
    $phoneNumber = filter_input(INPUT_POST,"phone",FILTER_SANITIZE_STRING);

    if ($name == null || $name == false || $phoneNumber == false || $phoneNumber == null || $userID == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        $output = $userFunctions->editUserDetails($userID,$name,$phoneNumber);

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
