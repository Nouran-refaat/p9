<?php


include_once "layouts/header.php";
include_once "middleware/auth.php";
include_once "layouts/nav.php";
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 h1 text-center text-primary">Home</div>
        <div class="col-4 offset-4">
            <h1 class="display-3 text-dark text-center"> Welcome <?= $_SESSION['user']['name'] ?> </h1>
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php"; ?>