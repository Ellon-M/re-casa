<?php
use App\Processors\UserFunctions;

require '../app/vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userFunctions = new UserFunctions();

    $oldPassword = filter_input(INPUT_POST,"old_password",FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST,"new_password",FILTER_SANITIZE_STRING);
    $userID = filter_input(INPUT_POST,"user_id",FILTER_SANITIZE_NUMBER_INT);

    if ($userID == null || $oldPassword == null || $newPassword == null){
        ?>
        <hr><div class="alert alert-danger"><p align="center"><strong>
                    <i class="fa fa-exclamation-triangle"></i> Error Processing Request!</strong>
                Provide all the details</p></div>
        <?php
    }else{
        $output = $userFunctions->changePassword($userID,$oldPassword,$newPassword);

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