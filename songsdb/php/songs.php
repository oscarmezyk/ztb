<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        
        <a href="songs.php">Songs</a>
        <a href="cart.php">Cart</a>
        <a href="index.php">Logout</a>
        <a href="about.php">About</a>
    </div>
    <div class="content">
        <h2>Available Songs</h2>
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit();
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pageusers";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM songs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul class='song-list'>";
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row['song_name'] . " - " . $row['artist'] . " <a href='add_to_cart.php?song_id=" . $row['id'] . "'>Add to Cart</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No songs available</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
