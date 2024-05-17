<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Login & Register</title>
</head>

<body>
    <div class="main">
        <?php
        if (isset($_SESSION["errors"]) && !empty($_SESSION["errors"])) {
            echo "<div style='color: red;'>";
            foreach ($_SESSION["errors"] as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
            echo "</div>";
            // Clear the errors after displaying
            unset($_SESSION["errors"]);
        }
        ?>
        <div class="form-wrapper">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form action="inc/register.php" method="post">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="username" placeholder="User name:">
                    <input type="email" name="useremail" placeholder="Email:">
                    <input type="password" name="userpass" placeholder="Password:">
                    <input type="password" name="reppass" placeholder="Repet Password:">
                    <button>Sign up</button>
                </form>
            </div>

            <div class="login">
                <form action="inc/login.php" method="post">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="useremail" placeholder="Email:">
                    <input type="password" name="userpass" placeholder="Password:">
                    <button>Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>