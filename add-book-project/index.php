<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Book List</title>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Book List</h1>
            <div>
                <a class="btn btn-primary" href="form/add-book.php">Add New Book</a>
            </div>
        </header>
        <?php if (isset($_SESSION["deleted"]) && !empty($_SESSION["deleted"])) : ?>
            <div class="alert alert-success mt-4" role="alert">
                <?php echo $_SESSION["deleted"]; ?>
                <?php unset($_SESSION["deleted"]); ?>
            </div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conneted to database
                require_once("loader/db-connection.php");
                // SQL to select and show data
                $sql = "SELECT * FROM books";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $result = $stmt->fetchAll();

                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->author; ?></td>
                            <td><?php echo $row->type; ?></td>
                            <td>
                                <a href="inc/view-book.php?id=<?php echo $row->id ?>" class="btn btn-info">Read More</a>
                                <a href="inc/edit-book.php?id=<?php echo $row->id ?>" class="btn btn-warning">Edit</a>
                                <a href="inc/delete-book.php?id=<?php echo $row->id ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>