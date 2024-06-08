<?php
session_start();
$title = "Home page";
include_once "inc/header.php";
?>

<main class="container py-3">
    <h1>This is Home page</h1>
    <?php if (isset($_SESSION["added"]) && !empty($_SESSION["added"])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION["added"]; ?>
            <?php unset($_SESSION["added"]); ?>
        </div>
    <?php endif; ?>
    <div class="row my-4">
        <div class="col-12 col-lg-4 col-md-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link btn btn-primary">Card link</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link btn btn-primary">Card link</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link btn btn-primary">Card link</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link btn btn-primary">Card link</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "inc/footer.php"; ?>