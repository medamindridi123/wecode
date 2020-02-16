<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <?php
        if (!isset($_SESSION['logged_id'])) {
            header("location:../index.php");
            exit();
        }else {
            echo '<form action="../inc/logout.php" method="post"><input type="submit" value="Logout"></form>';
            echo 'Hello '.$_SESSION['logged_user'];
        }
    ?>
</body>
</html>