<?php
session_start();

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        echo "null submission!";
    } else {

        $file = fopen("users.txt", "r");
        $validUser = false;

        while (!feof($file)) {

            $line = trim(fgets($file));
            if ($line == "") continue;

            list($fileUser, $filePass) = explode(",", $line);

            if ($username == $fileUser && $password == $filePass) {
                $validUser = true;
                break;
            }
        }

        fclose($file);

        if ($validUser) {
            $_SESSION['status'] = true;
            $_SESSION['username'] = $username;
            header('location: home.php');
        } else {
            echo "invalid user!";
        }
    }

} else {
    header('location: login.php');
}
?>
