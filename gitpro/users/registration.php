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
session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

// HASH PASSWORD
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
 
    if ($name && $username && $email && $password) {
 
        $role = "customer";
        $created_at = date("Y-m-d H:i:s");
 
        $query = "INSERT INTO users (name, username, email, password, role, created_at)
          VALUES ('$name', '$username', '$email', '$hashedPassword', '$role', '$created_at')";
 
        $result = mysqli_query($conn, $query);
 
        if ($result) {
            // Auto-login after registration
            $user_id = mysqli_insert_id($conn);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
 
            echo "<script>
                    alert('You are registered successfully.');
                    window.location.href = '../menu.php';
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
 
    <input type="text" name="name" placeholder="Full Name" class="login-input" required>
 
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
