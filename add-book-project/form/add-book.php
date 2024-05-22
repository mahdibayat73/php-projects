<?php 
require_once("../loader/db-connection.php");
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
                <a class="btn btn-primary" href="#">Back</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <div class="form-element my-4">
                <input class="form-control" type="text" name="title" placeholder="Book Title:">
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="title" placeholder="Author Name:">
            </div>
            <div class="form-element my-4">
                <select class="form-control" name="type">
                    <option value="">Select Book Type</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Fantast">Fantast</option>
                    <option value="SciFi">SciFi</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>
            <div class="form-element my-4">
                <input class="form-control" type="text" name="desc" placeholder="Book Desctiption:">
            </div>
            <div class="form-element">
                <input class="btn btn-success" type="submit" name="create" value="Add Book">
            </div>
        </form>
    </div>
</body>
</html>