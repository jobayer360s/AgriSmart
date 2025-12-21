<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Farmers Login</h2>

    <form action="loginCheck.php" method="post">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="input-group">
            <input type="submit" name="submit" value="Login">
        </div>

    </form>
    <h4>Dont have accout ? </h4>
    <a href="signup.php">Join Now</a>
</div>

</body>
</html>
