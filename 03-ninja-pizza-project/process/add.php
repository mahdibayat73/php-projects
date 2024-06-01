<?php

// Create a function to validate inputs
function validate_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"])) {
        // Initialize variables with empty values
        $email = $title = $ingredients = "";
        $email = validate_input($_POST["email"]);
        $title = validate_input($_POST["title"]);
        $ingredients = validate_input($_POST["ingredients"]);
    } 
} else {
    header("Location: ../add-pizza.php");
    exit();
}
