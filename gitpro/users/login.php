<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Baresto | Login Form</title>

    <link rel="stylesheet" href="../assets/css/login.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">

    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>

<?php
include '../config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // STEP 1: GET USER ONLY BY USERNAME
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // STEP 2: VERIFY HASHED PASSWORD
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: /gitpro/menu.php");
            }
            exit();

        } else {
            echo "<div class='form'>
                    <h3>Incorrect Password</h3>
                    <p><a href='login.php'>Try again</a></p>
                  </div>";
        }

    } else {
        echo "<div class='form'>
                <h3>User not found</h3>
                <p><a href='login.php'>Try again</a></p>
              </div>";
    }
}
?>

<!-- LOGIN FORM -->
<form class="form" method="post">

    <center>
        <img src="../assets/images/logo.png" class="img img-fluid">
    </center>

    <hr>

    <h1 class="login-title">Login</h1>

    <input type="text" name="username" class="login-input" placeholder="Username" required>

    <input type="password" name="password" class="login-input" placeholder="Password" required>

    <input type="submit" value="Login" class="login-button">

    <p class="link">
        Don't have an account?
        <a href="registration.php">Register here!</a>
    </p>

    <hr>

    <!-- Google Login -->
    <div id="g_id_onload"
        data-client_id="838321752460-6ah497tdpkbekj7lfj5so48suaqhu1e7.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-login_uri="https://Baristocoffeeshop.infinityfreeapp.com"
        data-auto_prompt="false">
    </div>

    <div class="g_id_signin"
        data-type="standard"
        data-shape="rectangular"
        data-theme="outline"
        data-text="signin_with"
        data-size="large"
        data-logo_alignment="center">
    </div>

</form>

<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;

    $.ajax({
        type: 'POST',
        url: 'set_session.php',
        data: { id_token: id_token },
        success: function () {
            window.location.href = 'index.php';
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
}
</script>

</body>
</html>