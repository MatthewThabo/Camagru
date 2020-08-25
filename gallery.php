<?php if (isset($_SESSION['id'])) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <title>Gallery</title>
</head>
<style type="text/css">
        body { font-family: Arial, Helvetica, sans-serif;
                background-color: coral;  }
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
<?php if (isset($_SESSION['id'])) { ?>
    <div id="navbar">
        <a href="#" id="logo">CAMAGRU</a>
        <div id="navbar-right">
            <a href="index.php">Home</a>
            <a href="edit_account.php">Edit Account</a>
            <a href="logout.php">Logout</a>
            <a href="gallery.php">Gallery</a>
        </div>
    </div>
<?php } else { ?>
    <div id="navbar">
        <a href="#" id="logo">CAMAGRU</a>
        <div id="navbar-right">
            <a href="home.php">Back</a>
        </div>
    </div>
<?php } ?>
<br>
<br>
<br>
<?php
                include_once ('config/database.php');

                try {
                    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $db->prepare("SELECT * FROM gallery");
                    $value = array($_SESSION['id']);
                    $query->execute($value);

                    $result = $query->fetchAll();
                    foreach ($result as $v) { ?>
                            <img class="img" src="<?php echo $v['img_name']; ?>" width="430" height="380">
                            <!-- <a class="btn" href="delete.php?id=<?php echo $v['id']; ?>">delete</a> -->
                    <?php }
                } catch (PDOException $e) {
                        return $e->getMessage();
                }
                    $db = null;
                ?>


</body>
<footer>
        <div>
            <p><em>&copy; Copyright 2018 tmatlena. All rights reserved.</em></p>
        </div>
    </footer>
</html>