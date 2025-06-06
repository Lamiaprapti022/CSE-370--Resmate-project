<?php
session_start();
include("dbcon.php");

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query2 = "SELECT * FROM admin WHERE name='$email' AND password='$password'";
        $login_query_run = mysqli_query($con, $login_query);
        $login_query_run2 = mysqli_query($con, $login_query2);

        if (mysqli_num_rows($login_query_run)) {
            $row = mysqli_fetch_array($login_query_run);

            // Check if user is banned
            if ($row['is_banned'] == 1) {
                $_SESSION['status'] = "Your account has been banned. Please contact support.";
                header('Location: login.php');
                exit(0);
            }

            // Check email verification
            if ($row['verify_status'] == 1) {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'id' => $row['user_id'],
                    'username' => $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                ];
                $_SESSION['status'] = "You are Logged In.";
                header('Location: home_user.php');
                exit(0);
            } else {
                $_SESSION['status'] = "Please verify your Email Address to Login";
                header('Location: login.php');
                exit(0);
            }
        } else if (mysqli_num_rows($login_query_run2)) {
            $row = mysqli_fetch_array($login_query_run2);

            $_SESSION['authenticated'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['name'],
                'is_admin' => TRUE
            ];
            $_SESSION['status'] = "You are Logged In.";
            header('Location: home_admin.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Invalid Email or Password";
            header('Location: login.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields are mandatory!";
        header('Location: login.php');
        exit(0);
    }
}
?>
