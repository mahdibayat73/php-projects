<?php
session_start();
$pageTitle = "Home page";
include_once "inc/header.php";
include_once "loader/db_connection.php";
?>

<main class="container py-3">
    <h1>Pizzas!</h1>
    <?php if (isset($_SESSION["added"]) && !empty($_SESSION["added"])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION["added"]; ?>
            <?php unset($_SESSION["added"]); ?>
        </div>
    <?php endif; ?>

    <div class="row my-4">
        <!-- slq to get data -->
        <?php
        $sql = "SELECT * FROM pizzas";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();

        $conn = null;
        ?>

        <?php if ($result) : ?>
            <?php foreach ($result as $row) : ?>
                <div class="col-12 col-lg-4 col-md-6 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $row->title; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $row->ingredients; ?>
                            </p>
                            <a href="pizza-single.php?id=<?php echo $row->id; ?>" class="card-link btn btn-primary">Show Pizza</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</main>

<?php include_once "inc/footer.php"; ?>