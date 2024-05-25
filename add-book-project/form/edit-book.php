<?php
session_start();
require_once("../loader/db-connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Book</title>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Book</h1>
            <div>
                <a class="btn btn-primary" href="../index.php">Back</a>
            </div>
        </header>
        <?php

        // Code to edit book
        if ( isset($_GET["id"]) ) {
            $id = $_GET["id"];
            // SQL to update data
            try {
                $sql = "SELECT * FROM books WHERE id=$id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $result = $stmt->fetch();
            } catch ( PDOException $e ) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }

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
        <?php if (isset($_SESSION["edited"]) && !empty($_SESSION["edited"])) : ?>
            <div class="alert alert-success mt-4" role="alert">
                    <?php echo $_SESSION["edited"]; ?>
            </div>
            <?php unset($_SESSION["edited"]); ?>
        <?php endif; ?>
        <form action="../inc/edit-process.php" method="post">
            <div class="form-element my-4">
                <input class="form-control" type="text" name="title" placeholder="Book Title:" value="<?php echo $result->title; ?>">
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="author" placeholder="Author Name:" value="<?php echo $result->author; ?>">
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="type">
                    <option value="">Select Book Type</option>
                    <option value="Adventure" <?php echo $result->type == 'Adventure' ? 'selected' : ''; ?> >Adventure</option>
                    <option value="Fantast" <?php echo $result->type == 'Fantast' ? 'selected' : ''; ?> >Fantast</option>
                    <option value="SciFi" <?php echo $result->type == 'SciFi' ? 'selected' : ''; ?>>SciFi</option>
                    <option value="Horror" <?php echo $result->type == 'Horror' ? 'selected' : ''; ?> >Horror</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="desc" placeholder="Book Desctiption:" value="<?php echo $result->description; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $result->id ?>">
            <div class="form-element">
                <input class="btn btn-success" type="submit" name="edit" value="Edit Book">
            </div>
        </form>
    </div>
</body>

</html>