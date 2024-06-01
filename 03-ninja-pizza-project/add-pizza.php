<?php
session_start();
$pageTitle = "Add Pizza";
include_once "inc/header.php";
?>

<main class="container py-3">
    <?php
        if (isset($_SESSION["input_val"]) && !empty($_SESSION["input_val"])) {
            $email = htmlspecialchars($_SESSION["input_val"]["email"]);
            $title = htmlspecialchars($_SESSION["input_val"]["title"]);
            $ingredients = htmlspecialchars($_SESSION["input_val"]["ingredients"]);
            unset($_SESSION["input_val"]);
        } else {
            $email = '';
            $title = '';
            $ingredients = '';
        }
    ?>
    <h1>Order Your Pizza</h1>
    <form action="process/add.php" method="POST" id="form" class="p-4 bg-white rounded">
        <?php if (isset($_SESSION["errors"]) && !empty($_SESSION["errors"])) : ?>
            <?php foreach ($_SESSION["errors"] as $error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION["errors"]); ?>
        <?php endif; ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputTitle1" class="form-label">Pizza Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" id="exampleInputTitle1">
        </div>
        <div class="mb-3">
            <label for="exampleInputIngredients1" class="form-label">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" class="form-control" value="<?php echo $ingredients; ?>" id="exampleInputTitle1">
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="submit" class="btn btn-primary w-100 mt-2">
        </div>
    </form>
</main>

<?php include_once "inc/footer.php"; ?>