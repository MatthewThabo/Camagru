<?php

session_start();
unset($_SESSION);
session_destroy();
header("Location: /index.php");
?>

!<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>logout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="logout.css">
</head>
<body>
    Thanks for using Camagru :)
    <br>
    you are now offline......
</body>
</html>