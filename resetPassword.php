<?php
    include 'config/database.php';
    include 'forgot_password.php';

    if (isset($_GET["email"])) {
        $conn = new PDO("mysql:host=localhost;dbname=".$DB_NAME, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_GET['email'];
        $data = $conn->query("SELECT * FROM users WHERE email='$email'");
        $count = $data->rowCount();
        if ($count == 1) {
            $str = "0123456789abcdefghijkl";
            $str = str_shuffle($str);
            $str = substr($str, 0, 15);

            $password = sha1($str);

            $conn->query("UPDATE users SET pwd = '$password' WHERE email='$email'");

            echo "Your new password is: $str";
        }else {
            echo "Please check your link!";
        }
        }else {
            header("Location: login.php");
            exit();
        }
        ?>