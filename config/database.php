<?php
    $DB_NAME = "Camagru";
    $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "projects";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=".$DB_NAME, $DB_USER , $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        // echo "Error: ". $e->getMessage();
    }
?>
