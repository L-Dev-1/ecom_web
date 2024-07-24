<?php
require 'Config/dbcon.php';
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $sql = "SELECT username, role FROM tbl_users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        if ($data["role"] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: home");
        }
        exit();
    }
}
header("Location: login/index.php");
exit();
