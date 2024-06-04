<?php
session_start();
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
        $errors = [];

        // Collect all inputs into an array
        $inputs = [
            'email' => $email,
            'title' => $title,
            'ingredients' => $ingredients,
        ];

        // Check inputs not empty
        if (empty($email) || empty($title) || empty($ingredients)) {
            array_push($errors, "All fields are required!");
        }

        // Validate E-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email format!");
        }

        // Validate Title
        if (!preg_match("/^[a-zA-Z-' ]*$/", $title)) {
            array_push($errors, "Only letters and white space allowed for title!");
        }

        // Validate Ingredients
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            array_push($errors, "Ingredients must be a comma separated list!");
        }

        if (!empty($errors)) {
            // Set session variable
            $_SESSION["errors"] = $errors;
            $_SESSION["input_val"] = $inputs;
            header("Location: ../add-pizza.php");
        } else {
            require_once("../loader/db_connection.php");
        }
    }
} else {
    header("Location: ../add-pizza.php");
    exit();
}
