<?php require_once("../loader/db-connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <style>
        .book-details {
            background: #f5f5f5;
            padding: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Book Details</h1>
            <div>
                <a class="btn btn-primary" href="../index.php">Back</a>
            </div>
        </header>
        <div class="book-details">
            <?php if (isset($_GET["id"])) : ?>

                <?php
                try {
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM books WHERE id=$id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $result = $stmt->fetch();
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                ?>

                <h1>Book Title: <?php echo $result->title; ?></h1>
                <div class="mb-3">
                    <span>Author Name: <?php echo $result->author; ?>, </span>
                    <span>Book Type: <?php echo $result->type; ?></span>
                </div>
                <p>
                    <?php echo $result->description; ?>
                </p>

            <?php endif ?>
        </div>
    </div>
</body>

</html>