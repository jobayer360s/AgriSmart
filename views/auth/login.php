<?php require 'views/layout/header.php'; ?>

<div class="container">
    <h2>Farmers Login</h2>

    <form action="index.php?page=loginCheck" method="post">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <input type="submit" name="submit" value="Login">
    </form>

    <a href="index.php?page=signup">Join Now</a>
</div>

<?php require 'views/layout/footer.php'; ?>
