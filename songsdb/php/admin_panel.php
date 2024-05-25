<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'root') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>

    </style>
</head>
<body>
    <div class="navbar">
        <a href="admin_panel.php">Home</a>
        <a href="usersadmin.php">Users</a>
        <a href="songsadmin.php">Songs</a>
        <a href="index.php">Logout</a>
    </div>
    <div class="content">
        <h2>Admin Panel</h2>
        
    </div>
</body>
</html>
