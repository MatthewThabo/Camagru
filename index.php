<?php

    require_once ('functions/form_cleaner.php');
    require_once ('config/setup.php');
    session_start();

    if (isset($_POST['submit'])) {
        $username = test_input($_POST['uname']);
        $password = test_input($_POST['psw']);
        // echo $username . " " . $password; 

        // $error = "";

        if (empty($username) || empty($password)) {
            $error = "Please fill all fields";
        } else {
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
                    $psw = hash("whirlpool", $password);
                    if ($uname === $username && $psw === $pass) {
                        $_SESSION['id'] = $id;
                        header("Location: home.php");
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
if (isset($_POST['verify'])){
    $id = $_POST['uname'];
    try{
        $conn = new PDO($DB_DSN, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("UPDATE users SET validated='Y' WHERE username='$id'");
        $values = array($uname);
        $query->execute($values);
        header('Location: index.php');
    }
    catch(PDOException $e){
        echo 'Error: '. $e->getMessage();
    }
}
echo '<div style="text-align: left; color: seashell; padding: 0.01px; 
border-radius: 8px; background-color: coral; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
echo '<h2 style="padding: 2px;">Camagru</h2>';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<style type="text/css">
        footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: purple;
                color: white;
                text-align: center;
}
    </style> 
<body>

<form method="POST" action="" style="border:1px solid #ccc">
  <div class="container">
	<h2>Login Form</h2>
	<hr>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw">

     <div class="clearfix">   
    <button type="submit" name="submit" class="loginbtn">Login</button>
     </div>
     <p><a href="signup.php" style="color:dodgerblue">Signup</a></p> 
     <p><a href="forgot_password.php" style="color:dodgerblue">Forgot Password</a></p> 
     <?php
      if (isset($error)) {
        echo $error;
      }
    ?>
  </div>
</form>

</body>
<footer>
        <div>
            <p><em>&copy; Copyright 2018 tmatlena. All rights reserved.</em></p>
        </div>
    </footer>
</html>
