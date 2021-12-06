<?php

    require_once ('functions/form_cleaner.php');
    require_once ('config/setup.php');

     if (isset($_POST['submit'])) {
        $username = test_input($_POST['name']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $confirmpassword = test_input($_POST['confirmpassword']);


        if (empty($username) || empty($password) || empty($email) || empty($confirmpassword)) {
            $error = "Please fill all fields";
        }
        else if (strlen($username) > 20 || strlen($username) < 4) {
            $error = "Username should be more than 4 characters";
        }
        else if (strlen($password) < 6)
        {
            $error = "Password must be atleast 6 characters";
        }
        else if (!preg_match('/[0-9]/', $password))
        {
            $error = "Password must have atleast one numeric ";
        }
        else if(!preg_match('/[A-Z]/', $password)){
            $error = "Password must have at least one uppercase letter";
        }
        else if (!preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $password))
        {
            $error = "Password must have at least one special character";
        }
        else if ($password != $confirmpassword) {
            $error = "Password do not match";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email";
        }
else {
    $password = hash("whirlpool", $password);
      try {
        $conn = new PDO($DB_DSN, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO users (email, username, pwd) VALUES (?, ?, ?)");
        $values = array($email, $username, $password,);
        $query->execute($values);
        //  if ($query == $values){
        //     $success = "Account registered, login";
        // }
        header('Location: index.php');
       
    //     $to = $email;
    //     $subject = "My subject";
    //     $txt = "registration complete! please confirm your email below.
    //     http://localhost:8080/camagru/verify.php?uname=$name";
    //     $headers = "From: tmatlena@camagru.com" . "\r\n" .
    //     "CC: somebodyelse@example.com";
      
    //     $jam = mail($to,$subject,$txt,$headers);
    //  if ($jam)
    //  {
    //    echo "Please check your email $name";
    //  }    
      } catch(PDOException $e) {
        echo "Error: ". $e->getMessage();
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
            <input id="email" class="text-input" type="text" placeholder="Email" name="email"></input>
        </div>
        <div class="input">
            <input id="password" class="text-input" type="text" placeholder="Password" name="password"></input>
        </div>
        <div class="input">
            <input id="confirmpassword" class="text-input" type="text" placeholder="Confirm password" name="confirmpassword"></input>
        </div>
        <div class="sign">
            <p class="text">Already have an account ?<a href="./index.php"> Login </a></p>
        </div> 
        <div class="btn">
            <button type="submit" name="submit" class="btn-1 hover-in-shadow" href="#">Signup</button>
        </div>
        <?php
            if (isset($error)) {
                echo "<div style=\"color: #FF686B;\">$error</div>";
            }
            // if (isset($success)){
            //     echo "<div style=\"color: #FF686B;\">$success</div>";
            // }
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