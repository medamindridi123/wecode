<?php
if (isset($_POST['clog'])) {
    require 'connect.php';
    $user   = $_POST['user'];
    $pass   = $_POST['pass'];
    if (empty($user) || empty($pass)) {
        header("location:../php/c_log.php?error=empty_fields");
        exit();
    }
    $sql = "SELECT * FROM company WHERE companyname=? OR companyemail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../php/c_log.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt , "ss" , $user, $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $passcheck = password_verify($pass, $row['companypassword']);
            if (!$passcheck) {
                header("location:../php/c_log.php?error=wrong_password");
                exit();
            }
            elseif ($passcheck) {


                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_user'] = $row['name'];

                header("location:add%20question.php?login=success");
                exit();
            }
            else {
                header("location:../php/c_log.php?error=wrong_password");
                exit();
            }
        }
        else {
            header("location:../php/c_log.php?error=nu_user");
        exit();
        }
    }
}
    else {
        header("location:../index.php");
        exit();
    }
