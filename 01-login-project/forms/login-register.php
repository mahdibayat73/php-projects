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
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="inc/register.php" method="post">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" placeholder="User name:">
                <input type="email" name="email" placeholder="Email:">
                <input type="password" name="pass" placeholder="Password:">
                <input type="password" name="reppass" placeholder="Repet Password:">
                <button>Sign up</button>
            </form>
        </div>

        <div class="login">
            <form action="inc/login.php" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email:">
                <input type="password" name="pass" placeholder="Password:">
                <button>Login</button>
            </form>
        </div>
    </div>
</body>

</html>