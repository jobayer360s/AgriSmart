<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Farmers Login</h2>
    <form action="index.php?page=loginCheck" method="post">
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <input type="submit" value="Login">
        </div>
    </form>
    <h4>Don't have account?</h4>
    <a href="index.php?page=home">Go Home</a>
</div>
<script src="assets/js/logic.js"></script>
</body>
</html>
