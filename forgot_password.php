<?php
    include 'config/database.php';
    include 'resetPassword';

    if (isset($_POST["forgotpswd"])) {
        $conn = new PDO("mysql:host=localhost;dbname=".$DB_NAME, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = htmlspecialchars($_POST["email"]);
        $data = $conn->query("SELECT * FROM users WHERE email='$email'");
        $count = $data->rowCount();

        if ($count == 1) {
            $str = "0123456789abcdefghijkl";
            $str = str_shuffle($str);
            $str = substr($str, 0, 10);
            $url = "http://localhost:8080/camagru/resetPassword.php?=$str&email=$email";

            mail($email, "Reset Password", "To reset your password, please visit this: $url", "From: tmatlena@camagru.com\r\n");
        }
        else {
            echo "Please check your inputs!";
        }
    }
    ?>
    <html>
    <body>
    <form action="forgot_password.php" method="POST">
        <input type="text" name="email" placeholder="Email"><br>
        <input type="submit" name="forgotpswd" value="Request Password"/>
    </form>
    </body>
    </html>