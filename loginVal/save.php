<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["fullName"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($name && $email && $phone && $password) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $file = fopen("users.txt", "a");
        fwrite($file, "Name: $name | Email: $email | Phone: $phone | Password: $hashedPassword\n");
        fclose($file);

        echo "Registration Successful!";
    } else {
        echo "Form data missing!";
    }

} else {
    echo "Invalid request!";
}
?>
