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
</main>

<?php include_once "inc/footer.php"; ?>