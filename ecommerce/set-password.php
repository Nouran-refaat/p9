<?php
include_once "layouts/header.php";
include_once "App/middlewares/guest.php";
include_once "App/Models/User.php";
include_once "App/Validations/registerRequest.php";

if(isset($_POST['set-password'])){
    $errors = [];
    $passwrodValidation = new registerRequest;
    $passwrodValidation->setPassword($_POST['password']);
    $passwrodValidation->setConfirmPassword($_POST['confirm_password']);
    $passwrodValidationResult = $passwrodValidation->passwordValidation();
    if(empty($passwrodValidationResult)){
        $updatePassowrd = new user;
        $updatePassowrd->setPassword($_POST['password']);
        $updatePassowrd->setEmail($_SESSION['check-code-email']);
        $updatePassowrdResult = $updatePassowrd->updatePassword();
        if($updatePassowrdResult){
            unset($_SESSION['check-code-email']);
            header('location:login.php');
        }else{
            $errors['something-wrong'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
        }
    }
}
//
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>New Password</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">New Password</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> New Password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="password" name="password" placeholder="New Password">
                                        <input type="password" name="confirm_password" placeholder="Confrim Password">
                                        <?php 
                                        if(!empty($passwrodValidationResult)){
                                            foreach ($passwrodValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button name="set-password" type="submit"><span>Set Password</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "layouts/footer.php";
?>