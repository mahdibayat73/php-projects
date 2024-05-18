<?php
session_start();

// Function for input validation
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = validate_input($_POST["useremail"]);
    $userPass = validate_input($_POST["userpass"]);
    
    $errors = [];

    // Checking fields are not empty
    if (empty($userEmail) || empty($userPass)) {
        array_push($errors, "All fields are required!");
    }
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format!");
    }

    if (empty($errors)) {        
        
        try {
            // Connect to MySQL server
            require_once("../../db-connection/db-connection.php");
            // Connect to the newly created database
            $pdo->exec("USE users01");

            // Prepare a select statement
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($userPass, $user['password'])) {
                // Password is correct
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../../index.php"); // Redirect to a welcome page or dashboard
                exit();
            } else {
                // Invalid credentials
                $errors[] = "Invalid email or password!";
            }
        } catch (PDOException $e) {
            // Handle database connection or query errors
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // Store errors in session to display them on the login page
    $_SESSION["errors"] = $errors;
    header("Location: ../login-register.php");
    exit();
}
?>
