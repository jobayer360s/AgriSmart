<?php




?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Signup Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Farmer Signup Form</h2>

 <form action="save.php" method="post" enctype="multipart/form-data" onsubmit="return validate()">

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


    <div id="success"></div>

    <script src="logic.js"></script>
</body>
</html>
