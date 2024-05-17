<?php 

session_start();

// Function for input validation
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data); // Correct function name
    $data = htmlspecialchars($data);
    return $data;
}

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = validate_input($_POST["username"]);
    $userEmail = validate_input($_POST["useremail"]);
    $userPass = validate_input($_POST["userpass"]);
    $repPass = validate_input($_POST["reppass"]);
    
    $errors = [];

    // Checking fields are not empty
    if (empty($userName) || empty($userEmail) || empty($userPass) || empty($repPass)) {
        array_push($errors, "All fields are required!");
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
        array_push($errors, "Only letters and white space allowed in username!");
    }
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format!");
    }
    if (strlen($userPass) < 8) {
        array_push($errors, "Password must be at least 8 characters long!");
    }
    if ($userPass !== $repPass) {
        array_push($errors, "Passwords do not match!");
    }

    // If there are errors, set them in the session and redirect back to login-register.php
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("Location: ../login-register.php");
        exit();
    }

}
?>
