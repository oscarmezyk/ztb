        <?php
        ini_set('display_errors', 'on');
        error_reporting(E_ALL);
        $sql = "SELECT * FROM genres";
        $result = $db->query($sql);

        echo "<h1>Genres</h1>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td><a href='songs.php?genre_id=" . $row['id'] . "'>" . $row['name'] . "</a></td></tr>";
            }
        } else {
            echo "<tr><td>No genres found</td></tr>";
        }
        ?>
