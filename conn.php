<?php
session_start();

require 'Config/dbcon.php';

if (isset($_POST['insert_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $uniqueId = "aga-" . uniqid();
    $sql = "INSERT INTO tbl_users (id, username, password, role) VALUES ('$uniqueId', '$username', '$password', $role)";


    // $sql = "INSERT INTO tbl_users(id, username, password, role) VALUES ('" . uniqid(prefix: "aga-") . "', '$username', '$password', '$role')";
    // $sql = "INSERT INTO tbl_users (id, username, password, role) VALUES ('"aga-" . substr(uniqid(), -5)', '$username', '$password', $role)";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('Add User Successfully!') </script>";
        header("Location: users.php");
        exit();
    } else {
        echo "<script> alert('Failed to Add User') </script>";
        header("Location: users.php");
        exit();
    }
}

if (isset($_POST["update_user"])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE tbl_users SET username = '$username', password = '$password', role = $role WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: users.php");
        exit();
    } else {
        echo "<script> alert('Failed to Edit User') </script>";
        header("Location: users.php");
        exit();
    }
}

if (isset($_POST["delete_user"])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tbl_users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: users.php");
        exit();
    } else {
        echo "<script> alert('Failed to Delete User') </script>";
        header("Location: users.php");
        exit();
    }
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password, role FROM tbl_users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_name'] = $data['username'];
        if ($data["role"] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: home");
        }
    } else {
        $error =  "Incorrect username or password";
        header("Location: login/index.php?msg=$error");
        // exit();
    }
}


// for logout 
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: ./");
}
