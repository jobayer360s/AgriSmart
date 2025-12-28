<?php require 'views/layout/header.php'; ?>

<div class="container">
<h2>Farmer Signup</h2>

<form action="index.php?page=saveUser" method="post" onsubmit="return validateSignup()">

<label>Full Name</label>
<input type="text" id="fullName" name="fullName">

<label>Email</label>
<input type="text" id="email" name="email">

<label>Phone</label>
<input type="text" id="phone" name="phone">

<label>Password</label>
<input type="password" id="password" name="password">

<label>Confirm Password</label>
<input type="password" id="confirmPassword">

<button type="submit">Submit</button>

</form>
</div>

<?php require 'views/layout/footer.php'; ?>
