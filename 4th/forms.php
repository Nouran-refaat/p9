<?php
// if($_POST){
//     print_r($_POST);die;
// }
if (isset($_POST['login'])) {
    $errors = [];
    if (empty($_POST['email'])) {
        $errors['email-error'] = "<div class='alert alert-danger'> Email Is Required </div>";
    }

    if (empty($_POST['password'])) {
        $errors['password-error'] = "<div class='alert alert-danger'> Password Is Required </div>";
    }
    // if( !( isset($_POST['email']) && $_POST['email'] ) ){
    //     $error = "<div class='alert alert-danger'> Email Is Required </div>";
    // }
}

if (isset($_POST['register'])) {
    // print_r($_POST);die;
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row m-5">
            <div class="col-12">
                <p class="text-danger display-4 text-center"> Ecommerce </p>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center text-dark h1"> Login </h1>
                    </div>
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">email</label>
                                <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?php
                                                                                                                                            if (isset($_POST['email'])) {
                                                                                                                                                echo $_POST['email'];
                                                                                                                                            }
                                                                                                                                            ?>">
                                <small id="helpId" class="text-muted">Help text</small>
                                <?php
                                if (isset($errors['email-error'])) {
                                    echo $errors['email-error'];
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="">password</label>
                                <input type="text" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Help text</small>
                                <?php
                                if (isset($errors['password-error'])) {
                                    echo $errors['password-error'];
                                }
                                ?>
                            </div>
                            <button name="login" class="rounded btn btn-outline-dark btn-small"> Login </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center text-primary h1"> Register </h1>
                    </div>
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">email</label>
                                    <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="">password</label>
                                    <input type="text" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Confrim password</label>
                                    <input type="text" name="confirm-password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select name="gender" class="form-control" id="">
                                    <option <?php echo( (isset($_POST['gender']) && $_POST['gender'] == 'm') ? 'selected' : '') ?> value="m"> Male </option>
                                    <option <?php if(isset($_POST['gender']) && $_POST['gender'] == 'f') {echo 'selected';} ?> value="f"> Female </option>
                                </select>
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <button name='register' class="rounded btn btn-outline-primary btn-small"> Register </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>