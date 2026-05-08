<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Baristo | Registration Form</title>

    <link rel="stylesheet" href="../assets/css/login.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
</head>

<body style="background: linear-gradient(135deg, #2b1b14, #4b2e22);">

<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($name && $username && $email && $password) {

        $role = "user";
        $create_datetime = date("Y-m-d H:i:s");

        $query = "INSERT INTO users (name, username, password, role, email, create_datetime)
                  VALUES ('$name', '$username', '$password', '$role', '$email', '$create_datetime')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>
                    alert('You are registered successfully.');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            echo "<p style='color:white;text-align:center;'>SQL Error: " . mysqli_error($conn) . "</p>";
        }

    } else {
        echo "<p style='color:white;text-align:center;'>All fields are required</p>";
    }
}
?>

<!-- FORM -->
<form class="form" method="post">

    <center>
        <img src="../assets/images/logo.png" class="img img-fluid">
    </center>

    <hr>

    <h1 class="login-title">Registration</h1>

    <input type="text" name="name" placeholder="Name" class="login-input" required>

    <input type="text" name="username" placeholder="Username" class="login-input" required>

    <input type="text" name="email" placeholder="Email Address" class="login-input" required>

    <input type="password" name="password" placeholder="Password" class="login-input" required>

    <input type="submit" value="Register" class="login-button">

    <p class="link">
        Already have an account?
        <a href="login.php">Login here</a>
    </p>

</form>

</body>
</html>