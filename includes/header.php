<?php if (isset($_SESSION['id'])) { ?>
    <div id="navbar">
        <a href="#" id="logo">CAMAGR~U</a>
        <div id="navbar-right">
            <a href="index.php">Home</a>
            <a href="edit_account.php">Edit Account</a>
            <a href="logout.php">Logout</a>
            <a href="gallery.php">Gallery</a>
        </div>
    </div>
<?php } else { ?>
    <div id="navbar">
        <a href="#" id="logo">CAMAGR~</a>
        <div id="navbar-right">
            <a href="../gallery2.php">Gallery</a>
        </div>
    </div>
<?php } ?>