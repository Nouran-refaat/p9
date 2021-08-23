<?php
include_once "layouts/header.php";
include_once "App/middlewares/guest.php";
include_once "App/Models/User.php";
include_once "App/Validations/checkCodeRequest.php";
if (!isset($_SESSION['check-code-email'])) {
    header('location:errors/404.php');
}
$queryString = new checkCodeRequest;
$queryStringResult = $queryString->verifyQueryString($_GET);
if ($queryStringResult) {
    $page = $queryStringResult;
} else {
    header('location:errors/404.php');
}
if (isset($_POST['check-code'])) {
    $errors = [];
    if (empty($_POST['code'])) {
        $errors['code-requried'] = "<div class='alert alert-danger'> Code Is Required </div>";
    }
    if (empty($errors)) {
        $check = new user;
        $check->setEmail($_SESSION['check-code-email']);
        $check->setCode($_POST['code']);
        $checkResult = $check->checkCode();
        if ($checkResult) {
            // update status 1
            $check->setStatus(1);
            $statusResult = $check->updateStatus();
            if ($statusResult) {
                // create session
                $user = $checkResult->fetch_object();
                if ($page == 'register' || $page == 'login') {
                    $_SESSION['user'] = $user;
                    // header index
                    unset($_SESSION['check-code-email']);
                    header('location:index.php');
                } elseif ($page == 'verify') {
                    $_SESSION['check-code-email'] = $user->email;
                    header('location:set-password.php');
                }
            } else {
                $errors['something-wrong'] = "<div class='alert alert-danger'> something went wrong </div>";
            }
        } else {
            $errors['code-wrong'] = "<div class='alert alert-danger'> Wrong Code </div>";
        }
    }
}
// validation
// check if code is correct => update status = 1  =>  => index.php
// if code is wrong => error message
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Check Code</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Check Code</li>
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
                            <h4> Check Code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="code" placeholder="Code">
                                        <?php
                                        if (isset($errors)) {
                                            foreach ($errors as $error) {
                                                echo $error;
                                            }
                                        }

                                        ?>
                                        <div class="button-box">
                                            <button name="check-code" type="submit"><span>Check Code</span></button>
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