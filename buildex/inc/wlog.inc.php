<?php
if (isset($_POST['wlog'])) {
    require 'connect.php';
    $user   = $_POST['user'];
    $pass   = $_POST['pass'];
    if (empty($user) || empty($pass)) {
        header("location:../php/wlog.php?error=empty_fields");
        exit();
    }
    else{
    $sql = "SELECT * FROM customers WHERE fullname='$user' OR email='$user'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {

        if ($pass!=$row['password']) {
            header("location:../php/wlog.php?error=wrong_password1"."  ".$row['password']."   ".$pass);
            exit();
        }
        elseif ($pass==$row['password']) {
            session_start();
            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['logged_user'] = $row['name'];

            header("location:../php/welcome.php?login=success");
            exit();
        }
        else {
            header("location:../php/wlog.php?error=wrong_password");
            exit();
        }
    }
    }
    else {
      //  header("location:../php/wlog.php?error=nu_user");
    exit();
    }

}
    else {
        header("location:../index.php");
        exit();
    }
