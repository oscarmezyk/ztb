<!DOCTYPE html>
<html lang="pl">
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

    <div class="header">
        <h1>Witaj na Portalu Muzycznym</h1>
        <p>Twoje ulubione miejsce do odkrywania i zapisywania ulubionych piosenek</p>
    </div>

    <div class="content">
        <h2>Wyszukaj interesujące Cię piosenki</h2>
        <?php
        session_start();

        $servername = "mysql.agh.edu.pl";
        $username = "wgrodzi1";
        $password = "LCUseesUrffV5sbq";
        $database = "wgrodzi1";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Połączenie nieudane: " . $conn->connect_error);
        }

        // Obsługa wyszukiwania
        $search_query = "";
        if (isset($_GET['search'])) {
            $search_query = $_GET['search'];
            $sql = "SELECT * FROM songs WHERE song_name LIKE '%$search_query%' OR artist LIKE '%$search_query%' OR genre LIKE '%$search_query%' LIMIT 12";
        } else {
            $sql = "SELECT * FROM songs LIMIT 12";
        }

        $result = $conn->query($sql);
        ?>
        <div class="search-bar">
            <form action="index.php" method="get" class="search-form">
                <label for="search" class="search-label">Szukaj piosenek, wykonawców, gatunków...</label>
                <input type="text" id="search" name="search" placeholder="Wpisz szukaną frazę" value="<?php echo htmlspecialchars($search_query); ?>">
                <input type="submit" value="Szukaj">
            </form>
        </div>
        <div class="song-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='song'>";
                echo "<h3>" . $row['song_name'] . "</h3>";
                echo "<p>Artysta: " . $row['artist'] . "</p>";
                echo "<p>Gatunek: " . $row['genre'] . "</p>";
                echo "<form action='add_to_favorites.php' method='post'>";
                echo "<input type='hidden' name='song_id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Dodaj do ulubionych'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>Brak dostępnych piosenek</p>";
        }
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
