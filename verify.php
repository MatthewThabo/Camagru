<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>verify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="verify"></script>
</head>
<body>
    <form action="index.php" method="POST">
    <input type="hidden" name="uname" value="<?php echo $_GET["uname"]?>"/>
        <button type="submit" name="verify" class="verifybtn">Verify</button>
    </form>
</body>
</html>