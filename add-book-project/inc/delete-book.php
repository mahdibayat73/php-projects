<?php 
session_start();

try {
    if ( isset($_GET["id"]) ) {
        $id = $_GET["id"];
        require_once("../loader/db-connection.php");
        $sql = "DELETE FROM books WHERE id = $id";
        $conn->exec($sql);
        $_SESSION["deleted"] = "Record deleted successfully";
        header("Location: ../index.php");
    }
} catch ( PDOException $e ) {
    echo $sql . "<br>" . $e->getMessage();
}