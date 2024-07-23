<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login/index.php");
    exit();
}

// User is logged in, display protected content
header("Location: login/index.php");
?>