<?php

    require_once ('functions/form_cleaner.php');
    require_once ('config/setup.php');

     if (isset($_POST['submit'])) {
        $username = test_input($_POST['name']);
        $password = test_input($_POST['password']); 

        if (empty($username) || empty($password)) {
            $error = "Please fill all fields";
        }
        else {
            try {
                $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $db->prepare("SELECT * FROM users WHERE username = '$username'");
                $value = array($username);
                $stmt->execute($value);
                $results = $stmt->fetchAll();
                $rowCount = $stmt->rowCount();
                if ($rowCount > 0) {
                    foreach ($results as $value) {
                        $id = $value['id'];
                        $uname = $value['username'];
                        $pass = $value['pwd'];
                    }
                    $password = hash("whirlpool", $password);
                    if ($uname === $username && $pass === $password) {
                        // $_SESSION['id'] = $id;
                       header("Location: ./main.php");
                    } else {
                        $error = "Incorrect username or password";
                    }
                } else {
                    $error = "User does not exist";
                }
            } catch (PDOException $e) {
                echo "ERROR SELECTING Users: \n" . $e->getMessage() . "\nAborting process\n";
                exit;
	    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/effect.css">
    <link rel="stylesheet" href="./responsive/responsive.css">
    <title>Camagru</title>
</head>
 
<body>
        <div class="effect-wrap">
                <div class="effect effect-1">
                </div>
                <div class="effect effect-2">
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div> 
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                </div>
                <div class="effect effect-3">
                </div>
                 <div class="effect effect-4">
                </div>
                <div class="effect effect-5">
                     <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                     <div></div><div></div><div></div>
                </div>
            </div>
    <div class="card">
        <div class="text-head">
            <h2>Camagru</h2>
        </div>
         <form method="POST" action="">
        <div class="input">
            <input id="name" class="text-input" type="text" placeholder="Username" name="name"></input>
        </div> 
        <div class="input">
            <input id="password" class="text-input" type="text" placeholder="Password" name="password"></input>
        </div>
        <div class="sign">
            <p class="text">Click here to <a href="./signup.php">Signup </a></p>
        </div> 
        <div class="sign">
            <p class="text">Forgot password ? <a href="./forgot_password.php">Reset </a></p>
        </div> 
        <div class="btn">
            <button type="submit" name="submit" class="btn-1 hover-in-shadow" href="./main.php">Login</button>
        </div>
         <?php
            if (isset($error)) {
                echo "<div style=\"color: #FF686B;\">$error</div>";
      }
    ?>
    </form>
    </div>
</body>
<footer>
        <div>
            <p><em>&copy; Copyright 2018 Thabo Matlenana. All rights reserved.</em></p>
        </div>
</footer>
</html>
