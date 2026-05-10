<?php
session_start();
include '../config/db.php';

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // simple admin check (you can later connect DB users table)
    if ($username == "baresto" && $password == "bar1234") {

        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            /* coffee theme background */
            background: linear-gradient(135deg, #3d2402, #461f04, #a67b5b);
        }

        .login-box {
            width: 350px;
            padding: 35px;
            background: #fffaf3;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .login-box h2 {
            color: #5a3e2b;
            margin-bottom: 20px;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;

            border: 1px solid #c9a27e;
            border-radius: 8px;
            outline: none;
        }

        .login-box button {
            width: 100%;
            padding: 12px;

            background: #6f4e37;
            color: white;

            border: none;
            border-radius: 8px;

            cursor: pointer;
            font-weight: bold;
        }

        .login-box button:hover {
            background: #5a3e2b;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

<div class="login-box">

    <h2>☕ Admin Login</h2>

    <?php if ($error != "") { echo "<div class='error'>$error</div>"; } ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username"><br>

        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit" name="login">Login</button>

    </form>

</div>

</body>
</html>