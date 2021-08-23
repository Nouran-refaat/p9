<?php

include_once "layouts/header.php";
include_once "App/middlewares/guest.php";
include_once "layouts/nav.php";
include_once "App/Validations/registerRequest.php";
include_once "App/Models/User.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

if ($_POST) {
    // validation
    $errors = [];
    $validation = new registerRequest;
    $validation->setPassword($_POST['password']);
    $validation->setConfirmPassword($_POST['confirm_password']);
    $passwordValidtionResult = $validation->passwordValidation();

    $validation->setEmail($_POST['email']);
    $emailValidationResult = $validation->emailValidation();

    if (empty($emailValidationResult) and empty($passwordValidtionResult)) {

        // insert new user in db
        $user = new User;
        $user->setEmail($_POST['email']);
        // validate before insert if email is exists
        $emailExistResult = $user->emailCheck();
        if ($emailExistResult) {
            $errors['email'] = "<div class='alert alert-danger'> Email Already Exists </div>";
        } else {
            // inserUser in DB 
            $code = rand(10000, 99999);
            $user->setName($_POST['name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword($_POST['password']);
            $user->setGender($_POST['gender']);
            $user->setCode($code);
            $inserResult = $user->insertData();
            if ($inserResult) {
                // send mail

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'phpnti300100@gmail.com';                     //SMTP username
                    $mail->Password   = 'Nti300100';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('phpnti300100@gmail.com', 'Ecommerce');
                    $mail->addAddress($_POST['email']);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Verification Code';
                    $mail->Body    = "Dear {$_POST['name']},<br>Your Veification code:<b>$code</b><br>Thank You.";

                    $mail->send();
                    // header to check-code page
                    $_SESSION['check-code-email'] = $_POST['email'];
                    header('location:check-code.php?page=register');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
            } else {
                $errors['someThing'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
            }
        }
    }
}


?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Register</li>
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
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <?php
                                        if (isset($errors['someThing'])) {
                                            echo $errors['someThing'];
                                        }
                                        ?>
                                        <input type="text" name="name" placeholder="Name" value="<?php if (isset($_POST['name'])) {
                                                                                                        echo $_POST['name'];
                                                                                                    } ?>">
                                        <input type="tel" name="phone" placeholder="Phone" value="<?php if (isset($_POST['phone'])) {
                                                                                                        echo $_POST['phone'];
                                                                                                    } ?>">
                                        <input name="email" placeholder="Email" type="email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                        <?php
                                        if (isset($errors['email'])) {
                                            echo $errors['email'];
                                        }
                                        if (isset($emailValidationResult) && !empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        }

                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php if (isset($passwordValidtionResult) && !empty($passwordValidtionResult)) {
                                            foreach ($passwordValidtionResult as $key => $error) {
                                                echo $error;
                                            }
                                        } ?>
                                        <input type="password" name="confirm_password" placeholder="Confrim Password">
                                        <select name="gender" class="form-control" id="">
                                            <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'm') {
                                                        echo "selected";
                                                    } ?> value="m">Male</option>
                                            <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'f') ? 'selected' : '' ?> value="f">Female</option>
                                        </select>
                                        <br>
                                        <div class="button-box">
                                            <button name="register" type="submit"><span>Register</span></button>
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
<?php include_once "layouts/footer.php";  
?>