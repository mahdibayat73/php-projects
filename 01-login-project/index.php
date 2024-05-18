<?php 
session_start();
if ( !isset($_SESSION["username"]) ) {
    header("Location: forms/login-register.php");
}
echo "This is doshbord page";