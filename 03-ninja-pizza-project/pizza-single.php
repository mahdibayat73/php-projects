<?php
session_start();
$pageTitle = "Single Pizza Page";
include_once "inc/header.php";
include_once "loader/db_connection.php";

// Check GET request id param
function validate_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_GET['id'])) {
    $id = validate_input($_GET['id']);
    // Sql to get data
    try {
        $sql = "SELECT * FROM pizzas WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $pizza = $stmt->fetch();
    } catch (PDOException $err) {
        // echo "Sql erro r: " . $sql . "Error is: " . $err->getMessage();
    }
}

$conn = null;
?>
<main class="container py-3">
    <h1 class="text-center">Pizza's Page</h1>

    <?php if ($pizza) : ?>
        <h2>
            <?php echo $pizza->title; ?>
        </h2>
        <span>
            Created by: <?php echo $pizza->email; ?>
        </span>
        <span>|</span>
        <span>
            Created at: <?php echo date($pizza->created_at); ?>
        </span>
        <h3>ingredients:</h3>
        <p>
            <?php echo $pizza->ingredients; ?>
        </p>
        <?php else : ?>
            <h4>No such pizza exists!</h4>
    <?php endif; ?>

</main>


<?php include_once "inc/footer.php"; ?>