<?php
include_once "layouts/header.php";
include_once "App/middlewares/guest.php";
include_once "layouts/nav.php";
include_once "App/Validations/registerRequest.php";
include_once "App/Validations/loginRequest.php";
include_once "App/Models/User.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['login'])){
    // validation
    $errors = [];
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();

    $passwordValidation = new loginRequest;
    $passwordValidation->setPassword($_POST['password']);
    $passwordValidationResult = $passwordValidation->passwordValidation();

    if(empty($emailValidationResult) AND empty($passwordValidationResult)){
        $checkUser = new user;
        $checkUser->setEmail($_POST['email']);
        $checkUser->setPassword($_POST['password']);
        $loginResult = $checkUser->login();
        if($loginResult){
            $loggedInUser = $loginResult->fetch_object();
            if($loggedInUser->status == 1){
                $_SESSION['user'] = $loggedInUser;
                header('location:index.php');
            }elseif($loggedInUser->status == 2){
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
                    $mail->Body    = "Dear $loggedInUser->name,<br>Your Veification code:<b>$loggedInUser->code</b><br>Thank You.";

                    $mail->send();
                    // header to check-code page
                    $_SESSION['check-code-email'] = $_POST['email'];
                    header('location:check-code.php?page=login');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }else{
            $errors['authentication-failed'] = "<div class='alert alert-danger'> Athentication Failed </div>";
        }
    }   
    // check on (email,password)
    // => wrong => error message
    // => correct => check status => 1 => session => index page
    // => status = 2 => send mail => check code page
}
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>LOGIN</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Login</li>
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
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form  method="post">
                                        <input type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                                        <?php 
                                            if(!empty($emailValidationResult)){
                                                foreach ($emailValidationResult as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php 
                                         if(!empty($passwordValidationResult)){
                                            foreach ($passwordValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        if(!empty($errors)){
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                      
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="verify-email.php">Forgot Password?</a>
                                            </div>
                                            <button name="login" type="submit"><span>Login</span></button>
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