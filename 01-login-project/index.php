<?php 
session_start();

// Check if the user is logged in
if ( !isset($_SESSION["username"]) ) {
    header("Location: forms/login-register.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <form action="forms/inc/logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>
</body>
</html>