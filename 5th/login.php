<?php

include_once "layouts/header.php";
include_once "middleware/guest.php";
include_once "layouts/nav.php";
$users = [
    [
        'id' => 1,
        'name' => 'ahmed',
        'email' => 'ahmed@gmail.com',
        'password' => '123456',
        'image' => '1.png',
        'gender' => 'm'
    ],
    [
        'id' => 2,
        'name' => 'esraa',
        'email' => 'esraa@gmail.com',
        'password' => '123456',
        'image' => '2.png',
        'gender' => 'f'
    ],
    [
        'id' => 3,
        'name' => 'galal',
        'email' => 'galal@gmail.com',
        'password' => '123456',
        'image' => '3.png',
        'gender' => 'm'
    ]
];

// check if form has been submmited or not
if($_POST){
    // validation
    $errors = [];
    if(empty($_POST['email'])){
        $errors['email-required'] = "<div class='alert alert-danger '> Email Is Required </div>";
    }

    if(!$_POST['password']){
        $errors['password-required'] = "<div class='alert alert-danger '> Password Is Required </div>";
    }

    // check if user has right access
    if(empty($errors)){
        function login ($arrayUser){
            return $_POST['email'] == $arrayUser['email'] && $_POST['password'] == $arrayUser['password'];
        }
        $user = array_values(array_filter($users,'login'));
        if(empty($user)){
            $errors['wrong-attempt'] = "<div class='alert alert-danger '> Wrong Email Or Password </div>";  
        }else{
            // user & password => correct => save session => index.php
            $_SESSION['user'] = $user[0];
            header('location:index.php');
        }
    }
    
}



?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 h1 text-center text-primary">Login</div>
        <div class="col-4 offset-4">
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    <?php 
                    // validation error => print validation error msg
                    if(isset($errors['email-required'])){
                        echo $errors['email-required'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    <?php 
                    // validation error => print validation error msg
                    if(isset($errors['password-required'])){
                        echo $errors['password-required'];
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Login</button>
                <?php 
                // user || password => wrong => print error msg
                if(isset($errors['wrong-attempt'])){
                    echo $errors['wrong-attempt'];
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php"; ?>