<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pageusers";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['selected_songs'])) {
    $selected_songs = $_POST['selected_songs'];
    foreach ($selected_songs as $song_id) {
        $song_id = intval($song_id); // Ensure the ID is an integer
        $sql = "DELETE FROM songs WHERE song_id = $song_id";
        $conn->query($sql);
    }
    // Przekierowanie do songsadmin.php po usunięciu piosenek
    header("Location: songsadmin.php");
    exit();
} else {
    echo "No songs selected for deletion.";
}

$conn->close();
?>
