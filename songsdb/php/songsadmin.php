<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Songs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="admin_panel.php">Home</a>
        <a href="usersadmin.php">Users</a>
        <a href="songsadmin.php">Songs</a>
        <a href="index.php">Logout</a>
    </div>
    <div class="content">
        <h2>Admin Panel - Songs</h2>
        <div class="user-form">
            <form action="delete_song.php" method="post">
                <?php
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
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='song'>
                                  <input type='checkbox' name='selected_songs[]' value='" . $row['id'] . "' id='" . $row['id'] . "'>
                                  <label for='" . $row['id'] . "'>Song: " . $row['song_name'] . " - Artist: " . $row['artist'] . "</label>
                              </div>";
                    }
                } else {
                    echo "No songs found";
                }

                $conn->close();
                ?>
                <br>
                <input type="submit" value="Delete Selected Songs">
            </form>
        </div>
    </div>
</body>
</html>
