<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="adminlogin.php">Admin</a>
        <a href="about.php">About</a>
    </div>

    <div class="content">
        <h2>Wyszukaj interesujące Cie piosenki</h2>
        <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pageusers";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Obsługa wyszukiwania
        $search_query = "";
        if (isset($_GET['search'])) {
            $search_query = $_GET['search'];
            $sql = "SELECT * FROM songs WHERE song_name LIKE '%$search_query%' OR artist LIKE '%$search_query%'";
        } else {
            $sql = "SELECT * FROM songs";
        }

        $result = $conn->query($sql);
        ?>
        <form action="index.php" method="get" class="search-form">
            <input type="text" name="search" placeholder="Search songs" value="<?php echo htmlspecialchars($search_query); ?>">
            <input type="submit" value="Search">
        </form>
        <div class="song-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='song'>";
                echo "<h3>" . $row['song_name'] . "</h3>";
                echo "<p>Artist: " . $row['artist'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No songs available</p>";
        }
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
