<?php
include 'connect.php';
    if (isset($_POST['wsign'])) {
        $name   = $_POST['name'];
        $mail   = $_POST['mail'];
        $pass   = $_POST['pass'];
        $rpass  = $_POST['rpass'];
        $company_w_code = $_POST['company_w_code'];
        $customer_points = 0;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $name )) {
            header("location:../php/c_signup.php?error=invalid_username&mail=".$mail);
            exit();
        }
        elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            header("location:../php/wsign.php?error=invalid_email&user=".$name);
            exit();
        }
        elseif ($pass !== $rpass) {
            header("location:../php/wsign.php?error=incorrect_password&user=".$name."&mail=".$mail);
            exit();
        }
        else {
            $sql = "SELECT `Personid` FROM `customers` WHERE email=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location:../php/wsign.php?error=sqlerror_ohayo");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt , "s" , $mail);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultcheck = mysqli_stmt_num_rows($stmt);
                if ($resultcheck > 0) {
                    header("location:../php/wsign.php?error=mail_already_taken&user=".$name);
                    exit();
                } else {

                    $sql = "INSERT INTO customers(fullname, email, password,company_w_code,customer_points) VALUES ('$name', '$mail', '$pass', '$company_w_code', '$customer_points')";

                    if (mysqli_query($conn, $sql)) {
    header("location:../php/wlog.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
                  }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      } else {
        header("location:../index.php");
      exit();
    }
