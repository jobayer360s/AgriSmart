<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loginCheck()
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        echo "Please fill all fields!";
        return;
    }

    $filePath = __DIR__ . '/../users.txt';

    if (!file_exists($filePath)) {
        die("User file not found!");
    }

    $file = fopen($filePath, "r");
    $validUser = false;

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        if ($line === "") continue; // খালি line skip

        $parts = explode("|", $line);
        if (count($parts) < 2) continue; // যদি line এ | না থাকে skip

        $fileEmail = trim($parts[0]);
        $filePass  = trim($parts[1]);

        if ($email === $fileEmail && $password === $filePass) {
            $validUser = true;
            break;
        }
    }

    fclose($file);

    if ($validUser) {
        $_SESSION['user'] = $email;
        header("Location: index.php?page=dashboard");
    } else {
        echo "Invalid Email or Password!";
    }
}
