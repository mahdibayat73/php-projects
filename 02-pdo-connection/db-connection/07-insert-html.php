<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION)): ?>
        <?php echo $_SESSION["secc_insert"]; ?>
        <?php unset($_SESSION["secc_insert"]);?>
    <?php endif?>
    <form action="07-insert.php" method="POST">
        <input type="text" name="fname" placeholder="First name">
        <input type="text" name="lname" placeholder="Last name">
        <input type="submit" name="submit">
    </form>
</body>
</html>