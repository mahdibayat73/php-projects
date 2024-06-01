<?php
$title = "Add Pizza";
include_once "inc/header.php";
?>

<main class="container py-3">
    <h1>Order Your Pizza</h1>
    <form action="process/add.php" method="POST" id="form" class="p-4 bg-white rounded">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address:</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputTitle1" class="form-label">Pizza Title:</label>
            <input type="text" name="title" class="form-control" id="exampleInputTitle1">
        </div>
        <div class="mb-3">
            <label for="exampleInputIngredients1" class="form-label">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" class="form-control" id="exampleInputTitle1">
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="submit" class="btn btn-primary w-100 mt-2">
        </div>
    </form>
</main>

<?php include_once "inc/footer.php"; ?>