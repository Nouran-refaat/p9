<?php
include_once "layouts/header.php";
include_once "middleware/auth.php";
include_once "layouts/nav.php";


if ($_POST) {
    // validation
    // print_r($_FILES);die;
    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name-required'] = "<div class='alert alert-danger'> Name Is Required </div>";
    }

    if (empty($_POST['email'])) {
        $errors['email-required'] = "<div class='alert alert-danger'> Email Is Required </div>";
    }

    if (empty($_POST['gender'])) {
        $errors['gender-required'] = "<div class='alert alert-danger'> Gender Is Required </div>";
    }

    

    // update if no validations errors
    if (empty($errors)) {
        // check if server has photo
        if($_FILES['image']['error'] == 0){
            // validate on image size
            $maxUploadSize = 10 ** 6;
            if($_FILES['image']['size'] > $maxUploadSize){
                $errors['image']['image-size'] = "<div class='alert alert-danger'> Image Must Be Less than 1 MByte </div>";
            }
            // validate on image extension
            $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
            $allowedExtensions = ['png'];
            if(!in_array($extension,$allowedExtensions)){
                $errors['image']['image-extension'] = "<div class='alert alert-danger'> Photo Must be Png,Jpg,Jpeg only </div>";
            }
            
            if(empty($errors)){
                // generate image path with image name
                $photoPath = 'images/';
                $photoName = time() . '.' . $extension; // 1561313.png
                $fullPath = $photoPath . $photoName; // images/1561313.png
                // upload photo
                move_uploaded_file($_FILES['image']['tmp_name'],$fullPath);
                $_SESSION['user']['image'] = $photoName;
            }
        }
        $_SESSION['user']['name'] = $_POST['name'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['gender'] = $_POST['gender'];
        // save success msg
        $success = "<div class='alert alert-success'> Data Updated Successfully </div>";
    }
}


?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 text-dark text-center h1 "> Profile </div>
        <div class="col-12 text-center">
            <?php if (isset($success)) {
                echo $success;
            } ?>
        </div>
        <div class="col-6 offset-3">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6 offset-3">
                        <img src="images/<?= $_SESSION['user']['image'] ?>" class="rounded-circle" alt=" " width="100%">
                        <input type="file" name="image" class="form-control" id="exampleInputPassword1">
                        <?php 
                            if(isset($errors['image'])){
                                foreach($errors['image'] AS $key=>$error){
                                    echo $error;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" value="<?= $_SESSION['user']['name'] ?>">
                    <?php
                    if (isset($errors['name-required'])) {
                        echo  $errors['name-required'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $_SESSION['user']['email'] ?>">
                    <?php
                    if (isset($errors['email-required'])) {
                        echo  $errors['email-required'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Gender</label>
                    <select name="gender" class="form-control" id="exampleInputEmail2">
                        <option <?php if ($_SESSION['user']['gender'] == 'm') {
                                    echo "selected";
                                } ?> value="m">Male</option>
                        <option <?php if ($_SESSION['user']['gender'] == 'f') {
                                    echo "selected";
                                } ?> value="f">Female</option>
                    </select>
                    <?php
                    if (isset($errors['gender-required'])) {
                        echo  $errors['gender-required'];
                    }
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark mb-3 m-auto">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once "layouts/footer.php"; ?>