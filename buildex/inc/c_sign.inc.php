<?php
include 'connect.php';
if (isset($_POST['c_sign'])) {
        $n=10;
    function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    $code = getName($n);
    $name  = $_POST['c_name'];
    $mail  = $_POST['mail'];
    $pass  = $_POST['c_pass'];
    $rpass = $_POST['r_c_pass'];
    if (empty($name) || empty($pass) || empty($rpass) || empty($mail)) {
        header("location:../php/c_signup.php?error=empty_fields&name=".$name."&mail=".$mail."&pass=".$pass);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/" ,$name )) {
        header("location:../php/c_signup.php?error=invalid_username&mail=".$mail);
        exit();
    }
    elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("location:../php/c_signup.php?error=invalid_email&user=".$name);
        exit();
    }
    elseif ($pass !== $rpass) {
        header("location:../php/c_signup.php?error=incorrect_password&user=".$user."&mail=".$mail);
        exit();
    }
    else {
      $sql = "SELECT `companyid` FROM `company` WHERE companyemail=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location:../php/c_sign.php?error=sqlerror");
          exit();
        } else {
            mysqli_stmt_bind_param($stmt , "s" , $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("location:../php/c_signup.php?error=user_already_taken&user=".$user."&mail=".$mail);
                exit();
            } else {
                $sql = "INSERT INTO `company`(`companyname`, `companyemail`, `companypassword`, `company_w_code`) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location:../php/c_signup.phpsqlerror");
                    exit();
                } else {
                    $hpass = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt , "ssss" , $name, $mail, $hpass, $code);
                    mysqli_stmt_execute($stmt);
                    header("location:c_log.inc.php");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("location:../php/c_signup.php");
    exit();
}
