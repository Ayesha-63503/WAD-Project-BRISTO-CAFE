<?php
session_start();

// Remove all session variables
session_unset();

// Destroy session
session_destroy();
?>

<script>
    // Clear cart from localStorage
    localStorage.removeItem("cart");

    // Redirect
    window.location.href = "../index.php";
</script>