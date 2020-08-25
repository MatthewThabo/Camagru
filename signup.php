<?php

include 'functions/form_cleaner.php';
include 'config/database.php';

// $uname = $gender = $email = $psw = $pswrepeat = "";

if (isset($_POST['submit'])) {
  $uname = test_input($_POST["uname"]);
  $email = test_input($_POST["email"]);
  $psw = test_input($_POST["psw"]);
  $pswrepeat = test_input($_POST["pswrepeat"]);
  // echo $uname . " " . $email . " " . $psw . " " . $pswrepeat;

  if (empty($uname) || empty($psw) || empty($pswrepeat) || empty($email)) {
    $error = "Please fill all fields";
}
else if (strlen($uname) > 20 || strlen($uname) < 4) {
    $error = "Username should be between 4 and 20 characters";
}
else if (strlen($psw) < 6)
{
    $error = "Password must be atleast 6 characters";
}
else if (!preg_match('/[0-9]/', $psw))
{
    $error = "Password must have atleast one numeric ";
}
elseif(!preg_match('/[A-Z]/', $psw)){
    $error = "Password must have at least one uppercase letter";
}
elseif (!preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $psw))
{
    $error = "Password must have at least one special character";
}
else if ($psw != $pswrepeat) {
    $error = "Password do not match";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email";
}
else {
    $psw = hash("whirlpool", $psw);
      try {
        $conn = new PDO($DB_DSN, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO users (email, username, pwd) VALUES (?, ?, ?)");
        $values = array($email, $uname, $psw,);
        $query->execute($values);
        
        $to = $email;
        $subject = "My subject";
        $txt = "registration complete! please confirm your email below.
        http://localhost:8080/camagru/verify.php?uname=$uname";
        $headers = "From: tmatlena@camagru.com" . "\r\n" .
        "CC: somebodyelse@example.com";
      
        $jam = mail($to,$subject,$txt,$headers);
     if ($jam)
     {
       echo "Please check your email $uname";
     }    
      } catch(PDOException $e) {
        // echo "Error: ". $e->getMessage();
      }
   }
}

echo '<div style="text-align: left; color: seashell; padding: 0.01px; 
border-radius: 8px; background-color: coral; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
echo '<h1 style="padding: 2px;">Camagru</h1>';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/signup.css">
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
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email">

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter your username" name="uname">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw">

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="pswrepeat">
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>You already have an account <a href="index.php" style="color:dodgerblue">login</a>.</p>
    <input type="hidden" name="signup" value="signup">

    <div class="clearfix">
      <button type="submit" name="submit" class="signupbtn">Sign Up</button>
    </div>
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
