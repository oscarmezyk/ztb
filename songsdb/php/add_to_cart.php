<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['song_id'])) {
    $song_id = $_GET['song_id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!in_array($song_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $song_id;
    }
}

header("Location: songs.php");
exit();
?>
