<?php
include_once "layouts/header.php";
include_once "App/middlewares/auth.php";
include_once "layouts/nav.php";
include_once "App/Models/User.php";
include_once "App/Validations/registerRequest.php";
include_once "App/Models/Address.php";
include_once "App/Models/Region.php";
include_once "App/Models/City.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';


$errors = [];
$success = [];
$getUser = new user;
$addressData = new Address;

$getUser->setEmail($_SESSION['user']->email);
if (isset($_POST['update-profile'])) {


    if (empty($_POST['name'])) {
        $errors['profile']['name-required'] = "<div class='alert alert-danger'> Name Is Required <div>";
    }
    if (empty($_POST['phone'])) {
        $errors['profile']['phone-required'] = "<div class='alert alert-danger'> Phone Is Required <div>";
    }
    if (empty($_POST['gender'])) {
        $errors['profile']['gender-required'] = "<div class='alert alert-danger'> Gender Is Required <div>";
    }

    if (empty($errors['profile'])) {
        $getUser->setGender($_POST['gender']);
        $getUser->setName($_POST['name']);
        $getUser->setPhone($_POST['phone']);
        if ($_FILES['image']['error'] == 0) {
            if ($_FILES['image']['size'] > (10 ** 6)) {
                $errors['profile']['image-size'] = "<div class='alert alert-danger'> Image Size Must Be Less Than 1 Mega Byte <div>";
            }
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowedExtendsions = ['png', 'jpg', 'jpeg'];
            if (!in_array($extension, $allowedExtendsions)) {
                $errors['profile']['image-extension'] = "<div class='alert alert-danger'> Image Must be jpg,png,jpeg <div>";
            }

            if (empty($errors['profile'])) {
                $dir = 'assets/img/users/';
                $photoName = time() . '-' . $_SESSION['user']->id . '.' . $extension; // 1231521-9-.png
                $fullPath = $dir . $photoName;
                // upload photo to your server
                move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
                $getUser->setImage($photoName);
                $_SESSION['user']->image = $photoName;
            }
        }
        if (empty($errors['profile'])) {
            $updateDataResult = $getUser->updateData();
            if ($updateDataResult) {
                $_SESSION['user']->name = $_POST['name'];
                $_SESSION['user']->phone = $_POST['phone'];
                $_SESSION['user']->gender = $_POST['gender'];
                $success['profile'] = "<div class='alert alert-success text-center'> Profile Updated Successfully <div>";
            } else {
                $errors['profile']['something-wrong'] = "<div class='alert alert-danger'> Phone Already Exists <div>";
            }
        }
    }
}

if (isset($_POST['change-password'])) {
    if (!empty($_POST['old-password']) && !empty($_POST['new-password']) && !empty($_POST['confrim-password'])) {
        // get user from database
        $userResult = $getUser->emailCheck();
        $getUser->setPassword($_POST['old-password']);
        $user = $userResult->fetch_object();
        if ($user->password != $getUser->getPassword()) {
            $errors['change-password']['old-password'] = "<div class='alert alert-danger'> Your Old Password Is Wrong <div>";
        }
        $getUser->setPassword($_POST['new-password']);
        if ($user->password == $getUser->getPassword()) {
            $errors['change-password']['new-password'] = "<div class='alert alert-danger'> You have entered your old password again! <div>";
        }

        $passwordValidation = new registerRequest;
        $passwordValidation->setPassword($_POST['new-password']);
        $passwordValidation->setConfirmPassword($_POST['confrim-password']);
        $passwordValidationResult = $passwordValidation->passwordValidation();
        if (empty($passwordValidationResult) && empty($errors['change-password'])) {
            // update password in db
            $updatePassowrdResult = $getUser->updatePassword();
            if ($updatePassowrdResult) {
                $success['change-password'] = "<div class='alert alert-success text-center'> Your Password Updated Successfully <div>";
            } else {
                $errors['change-password']['something-wrong'] = "<div class='alert alert-danger'> Something Went Wrong! <div>";
            }
        }
    } else {
        $errors['change-password']['all-fields'] = "<div class='alert alert-danger'> All Fields Are Required <div>";
    }
}

if (isset($_POST['change-email'])) {
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();

    if ($_POST['email'] == $_SESSION['user']->email) {
        $errors['change-email']['email-old'] = "<div class='alert alert-danger'> Nothing to change <div>";
    }


    if (empty($emailValidationResult) && empty($errors['change-email'])) {
        $getUser->setEmail($_POST['email']);
        $userResult = $getUser->emailCheck();
        if ($userResult) {
            $errors['change-email']['email-exists'] = "<div class='alert alert-danger'> This Email Already Exists <div>";
        } else {
            $code = rand(10000, 99999);
            $getUser->setCode($code);
            $getUser->setStatus(2);
            $getUser->setId($_SESSION['user']->id);
            $updateEmailResult = $getUser->updateEmail();
            if ($updateEmailResult) {
                // send mail
                $_SESSION['user']->status = 2;
                $_SESSION['user']->email = $_POST['email'];
                $_SESSION['user']->code = $code;
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
                    $mail->Body    = "Dear {$_SESSION['user']->name},<br>Your Veification code:<b>$code</b><br>Thank You.";

                    $mail->send();
                    // header to check-code page
                    $_SESSION['check-code-email'] = $_POST['email'];
                    unset($_SESSION['user']);
                    header('location:check-code.php?page=my-account');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $errors['change-email']['something-wrong'] = "<div class='alert alert-danger'> Something went wrong <div>";
            }
        }
    }
}

if (isset($_POST['edit-address'])) {
    if (!empty($_POST['id']) && !empty($_POST['street']) && !empty($_POST['building']) && !empty($_POST['flat']) && !empty($_POST['floor']) && !empty($_POST['region_id'])) {
        $addressData->setId($_POST['id']);
        $addressData->setStreet($_POST['street']);
        $addressData->setFlat($_POST['flat']);
        $addressData->setFloor($_POST['floor']);
        $addressData->setBuilding($_POST['building']);
        $addressData->setNotes($_POST['notes']);
        $addressData->setRegion_id($_POST['region_id']);
        $addressDataResult = $addressData->updateData();
        if ($addressDataResult) {
            $success['edit-address'] = "<div class='alert alert-success'>  Address Updated Successfully </div>";
        } else {
            $errors['edit-address']['some-thing'] = "<div class='alert alert-danger'>  Something Went Wrong </div>";
        }
    } else {
        $errors['edit-address']['all-fields'] = "<div class='alert alert-danger'>  All Fields Are Required </div>";
    }
}

if (isset($_POST['add-address'])) {
    if (!empty($_POST['street']) && !empty($_POST['building']) && !empty($_POST['flat']) && !empty($_POST['floor']) && !empty($_POST['region_id'])) {
        $addressData->setStreet($_POST['street']);
        $addressData->setFlat($_POST['flat']);
        $addressData->setFloor($_POST['floor']);
        $addressData->setBuilding($_POST['building']);
        $addressData->setNotes($_POST['notes']);
        $addressData->setRegion_id($_POST['region_id']);
        $addressData->setUser_id($_SESSION['user']->id);
        $addressDataResult = $addressData->insertData();
        if ($addressDataResult) {
            $success['add-address'] = "<div class='alert alert-success'>  Address Added Successfully </div>";
        } else {
            $errors['add-address']['some-thing'] = "<div class='alert alert-danger'>  Something Went Wrong </div>";
        }
    } else {
        $errors['add-address']['all-fields'] = "<div class='alert alert-danger'>  All Fields Are Required </div>";
    }
}

if(isset($_POST['delete-address'])){
    // validation
    $addressData->setId($_POST['id']);
    $addressDataResult = $addressData->deleteData();
    if($addressDataResult){
        $success['delete-address'] = "<div class='alert alert-success'>  Address Deleted Successfully </div>";

    }else{
        $errors['delete-address']['some-thing'] = "<div class='alert alert-danger'>  Something Went Wrong </div>";

    }
}

$getUser->setEmail($_SESSION['user']->email);
$userResult = $getUser->emailCheck();
$user = $userResult->fetch_object();


$addressData->setUser_id($user->id);
$getAllAddressResult = $addressData->getAllAddress();


// ahmed

$citiesData = new City;
$citiesDataResult = $citiesData->selectData();
if ($citiesDataResult) {
    $cities = $citiesDataResult->fetch_all(MYSQLI_ASSOC);
}
// print_r($user);die;
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?= (isset($errors['profile']) or isset($success['profile'])) ? 'show' : '' ?>">
                                <!-- show -->
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="account-info-wrapper">
                                                <h4>My Account Information</h4>
                                                <h5>Your Personal Details</h5>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <ul class="alert">
                                                        <?php
                                                        if (isset($success['profile'])) {
                                                            echo $success['profile'];
                                                        }
                                                        if (isset($errors['profile'])) {
                                                            foreach ($errors['profile'] as $error) { ?>
                                                                <li class="alert-danger"> <?= $error ?> </li>
                                                        <?php }
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <div class="col-4 offset-4 text-center">
                                                    <img src="assets/img/users/<?= $user->image ?>" alt="" class="w-100 rounded-circle">
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-5">

                                                <div class="col-4">
                                                    <div class="billing-info">
                                                        <label>Name</label>
                                                        <input type="text" name="name" value="<?= $user->name ?>">
                                                        <?php
                                                        // if(isset($errors['profile']['name-required'])){
                                                        //     echo $errors['profile']['name-required'];
                                                        // }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select class="form-control" name="gender">
                                                            <option <?= $user->gender == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                                            <option <?php if ($user->gender == 'f') {
                                                                        echo 'selected';
                                                                    } ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button name="update-profile" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <form method="post">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="alert">
                                                        <?php
                                                        if (isset($success['change-password'])) {
                                                            echo $success['change-password'];
                                                        }
                                                        if (isset($errors['change-password'])) {
                                                            foreach ($errors['change-password'] as $error) { ?>
                                                                <li class="alert-danger"> <?= $error ?> </li>

                                                            <?php }
                                                        }
                                                        if (isset($passwordValidationResult)) {
                                                            foreach ($passwordValidationResult as $error) { ?>
                                                                <li class="alert-danger"> <?= $error ?> </li>
                                                        <?php
                                                            }
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="confrim-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button name="change-password" type="submit">Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-5">Change your Email </a></h5>
                            </div>
                            <div id="my-account-5" class="panel-collapse collapse  <?= (isset($errors['change-email']) or isset($emailValidationResult)) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <form method="post">
                                            <div class="account-info-wrapper">
                                                <h4>Change Email Address</h4>
                                                <h5>Your Email Address</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="alert">
                                                        <?php if (isset($errors['change-email'])) {
                                                            foreach ($errors['change-email'] as $error) { ?>
                                                                <li class="alert-danger"> <?= $error ?> </li>
                                                            <?php }
                                                        }

                                                        if (isset($emailValidationResult)) {
                                                            foreach ($emailValidationResult as $error) { ?>
                                                                <li class="alert-danger"> <?= $error ?> </li>
                                                        <?php }
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Eamil Address</label>
                                                        <input type="email" name="email" value="<?= $user->email ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button name="change-email" type="submit">Update Email</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse <?= (isset($errors['edit-address']) or $success['edit-address'] or $errors['add-address'] or $success['add-address'] or $errors['delete-address'] or $success['delete-address']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Add Address</h4>
                                            <?php
                                            if (isset($success['add-address'])) {
                                                echo $success['add-address'];
                                            }

                                            if (isset($errors['add-address'])) {
                                                foreach ($errors['add-address'] as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            ?>
                                            <div class="entries-wrapper mb-4">
                                                <div class="row">
                                                    <form action="" method="post">
                                                        <div class="col-lg-12 col-md-12 d-flex align-items-center justify-content-center">
                                                            <div class="row">
                                                                <div class="form-row col-6">
                                                                    <label for="">Street</label>
                                                                    <input type="text" name="street" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                                </div>
                                                                <div class="form-row col-6">
                                                                    <label for="">Building</label>
                                                                    <input type="text" name="building" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                                </div>
                                                                <div class="form-row col-6">
                                                                    <label for="">Flat</label>
                                                                    <input type="text" name="flat" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                                </div>
                                                                <div class="form-row col-6">
                                                                    <label for="">Floor</label>
                                                                    <input type="text" name="floor" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                                </div>
                                                                <div class="form-row col-12">
                                                                    <label for="">Regions</label>
                                                                    <select name="region_id" id="" class="form-control">
                                                                        <?php
                                                                        if (isset($cities)) {
                                                                            foreach ($cities as $index => $city) { ?>

                                                                                <optgroup label="<?= $city['name']; ?>">
                                                                                    <?php
                                                                                    $regionsData = new Region;
                                                                                    $regionsData->setCity_id($city['id']);
                                                                                    $regionsDataResult = $regionsData->selectRegionsByCity();
                                                                                    if ($regionsDataResult) {
                                                                                        $regions = $regionsDataResult->fetch_all(MYSQLI_ASSOC);
                                                                                        foreach ($regions as $index => $region) { ?>
                                                                                            <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                                                                    <?php }
                                                                                    } else {
                                                                                        echo "<option readonly disabled> No Regions Yet </option>";
                                                                                    }
                                                                                    ?>
                                                                                </optgroup>
                                                                        <?php }
                                                                        } else {
                                                                            echo "<optgroup readonly disabled> No Cities </optgroup>";
                                                                        }
                                                                        ?>



                                                                    </select>
                                                                </div>
                                                                <div class="form-row col-12">
                                                                    <label for="">Notes</label>
                                                                    <textarea name="notes" id="" class="form-control" cols="30" rows="10"></textarea>
                                                                </div>
                                                                <div class="form-row col-4 offset-4 text-center m-auto align-items-center justify-content-center">
                                                                    <!-- <div class="entries-edit-delete text-center"> -->
                                                                    <button name="add-address" class="d-block btn btn-success text-light rounded">Add Address</button>
                                                                    <!-- </div> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>
                                        <div>
                                            <?php


                                            if (isset($success['edit-address'])) {
                                                echo $success['edit-address'];
                                            }

                                            if (isset($errors['edit-address'])) {
                                                foreach ($errors['edit-address'] as $key => $error) {
                                                    echo $error;
                                                }
                                            }

                                            if (isset($success['delete-address'])) {
                                                echo $success['delete-address'];
                                            }

                                            if (isset($errors['delete-address'])) {
                                                foreach ($errors['delete-address'] as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!-- loop  -->
                                        <?php

                                        if ($getAllAddressResult) {
                                            $addresses = $getAllAddressResult->fetch_all(MYSQLI_ASSOC);
                                            foreach ($addresses as $index => $address) { ?>
                                                <div class="entries-wrapper mb-4">
                                                    <div class="row">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $address['id'] ?>">
                                                            <div class="col-lg-12 col-md-12 d-flex align-items-center justify-content-center">
                                                                <div class="row">
                                                                    <div class="form-row col-6">
                                                                        <label for="">Street</label>
                                                                        <input type="text" name="street" id="" value="<?= $address['street'] ?>" class="form-control" placeholder="" aria-describedby="helpId">
                                                                    </div>
                                                                    <div class="form-row col-6">
                                                                        <label for="">Building</label>
                                                                        <input type="text" name="building" id="" value="<?= $address['building'] ?>" class="form-control" placeholder="" aria-describedby="helpId">
                                                                    </div>
                                                                    <div class="form-row col-6">
                                                                        <label for="">Flat</label>
                                                                        <input type="text" name="flat" id="" value="<?= $address['flat'] ?>" class="form-control" placeholder="" aria-describedby="helpId">
                                                                    </div>
                                                                    <div class="form-row col-6">
                                                                        <label for="">Floor</label>
                                                                        <input type="text" name="floor" id="" value="<?= $address['floor'] ?>" class="form-control" placeholder="" aria-describedby="helpId">
                                                                    </div>
                                                                    <div class="form-row col-12">
                                                                        <label for="">Regions</label>
                                                                        <select name="region_id" id="" class="form-control">
                                                                            <?php
                                                                            if (isset($cities)) {
                                                                                foreach ($cities as $index => $city) { ?>

                                                                                    <optgroup label="<?= $city['name']; ?>">
                                                                                        <?php
                                                                                        $regionsData = new Region;
                                                                                        $regionsData->setCity_id($city['id']);
                                                                                        $regionsDataResult = $regionsData->selectRegionsByCity();
                                                                                        if ($regionsDataResult) {
                                                                                            $regions = $regionsDataResult->fetch_all(MYSQLI_ASSOC);
                                                                                            foreach ($regions as $index => $region) { ?>
                                                                                                <option <?= $region['id'] == $address['region_id'] ? 'selected' : '' ?> value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                                                                        <?php }
                                                                                        } else {
                                                                                            echo "<option readonly disabled> No Regions Yet </option>";
                                                                                        }
                                                                                        ?>
                                                                                    </optgroup>
                                                                            <?php }
                                                                            } else {
                                                                                echo "<optgroup readonly disabled> No Cities </optgroup>";
                                                                            }
                                                                            ?>



                                                                        </select>
                                                                    </div>
                                                                    <div class="form-row col-12">
                                                                        <label for="">Notes</label>
                                                                        <textarea name="notes" id="" class="form-control" cols="30" rows="10"><?= $address['notes'] ?></textarea>
                                                                    </div>
                                                                    <div class="form-row col-4 offset-4 text-center m-auto align-items-center justify-content-center">
                                                                        <!-- <div class="entries-edit-delete text-center"> -->
                                                                        <button name="edit-address" class="d-block btn btn-warning text-light rounded">Edit</button>
                                                                        <button name="delete-address" class="d-block  btn btn-danger text-light rounded">Delete</button>
                                                                        <!-- </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                        <?php }
                                        } else {
                                            echo "<div class='alert alert-warning'> No Addresses Yet </div>";
                                        }
                                        ?>

                                        <div class="billing-back-btn">
                                            <!-- <div class="billing-back">
                                                <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- my account end -->
<?php include_once "layouts/footer.php" ?>