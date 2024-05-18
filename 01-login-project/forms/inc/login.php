<?php 

// Function for input validation
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ( $_SERVER["REQUEST_MOTHOD"] == "POST" ) {
    $userEmail = validate_input($_POST["useremail"]);
    $userPass = validate_input($_POST["userpass"]);
    // Array for error handling
    $errors = [];

    // Checking fields are not empty
    if ( empty($userEmail) || empty($userPass) ) {
        array_push($errors, "All fields are required!");
    }
    if ( !filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
        array_push($errors, "Invalid email format!");
    }


}