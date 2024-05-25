<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['song_id'])) {
    $song_id = $_GET['song_id'];
    
    if (($key = array_search($song_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php");
exit();
?>
