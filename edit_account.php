<?php
    session_start();
    $id = $_SESSION['id'];
    require_once ('functions/form_cleaner.php');
    require_once ('config/database.php');
    try{
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $val = "N";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare('SELECT * FROM `users` WHERE id = :id');
    $statement->bindParam(":id", $id);
    $statement->execute();
    $user = $statement->fetch();
    }
    catch(PDOException $e) {
        echo "Error: ". $e->getMessage();
    }
    if (isset($_POST['submit'])) {
        $uname = test_input($_POST['uname']);
        $psw = test_input($_POST['psw']);
        $pswrepeat = test_input($_POST['pswrepeat']);
        $email = test_input($_POST['email']);
        $send = $_POST['send'];
        $error = "";
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
            $validated = "Y";
            $psw = hash("whirlpool", $psw);
            try {
                $psw = hash('whirlpool', $psw);
                $statement = $db->prepare("UPDATE users SET `pwd` = :pwd, username = :username, email = :email, validated = :val WHERE id = :id");
                $statement->bindParam(":id", $id);
                $statement->bindParam(":pwd", $psw);
                $statement->bindParam(":username", $uname);
                $statement->bindParam(":email", $email);
                $statement->bindParam(":val", $validated);
                $statement->execute();


                    $to = $email;
                    $subject = "Reset";
                    $txt = "Password Changed ! please confirm by clicking on the link below.
                    http://localhost:8080/camagru/verify.php?uname=$uname";
                    $headers = "From: tmatlena@camagru.com" . "\r\n" .
                    "CC: somebodyelse@example.com";
                if(isset($send)) {
                    mail($to,$subject,$txt,$headers);
                }
                echo "registration complete! please confirm your email";
            } catch(PDOException $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/signup.css">
    <link rel="stylesheet" type="text/css" href="style/edit_account.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="header">
    <div class="container"> <!-- container div -->
        <form action="" method="post">
            <h3 style="text-align: center">Acc Modify</h3>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter your username" name="uname">
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="pswrepeat">
            <label>
            <button type="submit" name="submit">Modify</button>
            <label for="send">Send Confirmation Email</label>
            <input type="checkbox" name="send">
            <!-- <span class="sgn">Already have an account? <a href="login.php">sign in</a></span><br> -->
            <br/>
            <?php
            if (isset($error)) {
                echo $error . "\n";
            }
            ?>
        </form>
    </div> <!-- end container div -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>