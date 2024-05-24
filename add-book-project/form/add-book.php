<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Book</title>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Add New Book</h1>
            <div>
                <a class="btn btn-primary" href="../index.php">Back</a>
            </div>
        </header>
        <?php
        // Get values from the query string if present
        if (isset($_SESSION['form_data'])) {
            $title = htmlspecialchars($_SESSION['form_data']['title']);
            $author = htmlspecialchars($_SESSION['form_data']['author']);
            $type = htmlspecialchars($_SESSION['form_data']['type']);
            $description = htmlspecialchars($_SESSION['form_data']['description']);
            unset($_SESSION['form_data']);
        }
        ?>
        <?php if (isset($_SESSION["errors"]) && !empty($_SESSION["errors"])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($_SESSION["errors"] as $error) : ?>
                    <?php echo $error . "<br>"; ?>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION["errors"]); ?>
        <?php endif; ?>
        <form action="../inc/process.php" method="post">
            <div class="form-element my-4">
                <input class="form-control" type="text" name="title" placeholder="Book Title:" value="<?php echo $title; ?>">
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="author" placeholder="Author Name:" value="<?php echo $author; ?>">
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="type">
                    <option value="">Select Book Type</option>
                    <option value="Adventure" <?php echo $type == 'Adventure' ? 'selected' : ''; ?> >Adventure</option>
                    <option value="Fantast" <?php echo $type == 'Fantast' ? 'selected' : ''; ?> >Fantast</option>
                    <option value="SciFi" <?php echo $type == 'SciFi' ? 'selected' : ''; ?>>SciFi</option>
                    <option value="Horror" <?php echo $type == 'Horror' ? 'selected' : ''; ?> >Horror</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="desc" placeholder="Book Desctiption:" value="<?php echo $description; ?>">
            </div>
            <div class="form-element">
                <input class="btn btn-success" type="submit" name="create" value="Add Book">
            </div>
        </form>
    </div>
</body>

</html>