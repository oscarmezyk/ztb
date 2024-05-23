<?php include('server.php') ?>
<?php

$genre_id = intval($_GET['genre_id']);
$sql = "SELECT songs.id, songs.title, bands.name AS band_name, bands.id AS band_id FROM songs 
        JOIN bands ON songs.band_id = bands.id 
        WHERE songs.genre_id = $genre_id";
$result = $db->query($sql);

$sql_genre = "SELECT name FROM genres WHERE id = $genre_id";
$genre_result = $db->query($sql_genre);
$genre = $genre_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Songs in <?php echo $genre['name']; ?></title>
    <style>
        table { width: 70%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Songs in <?php echo $genre['name']; ?></h1>
    <table>
        <tr>
            <th>Song Title</th>
            <th>Band</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td><a href='band.php?band_id=" . $row['band_id'] . "'>" . $row['band_name'] . "</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No songs found for this genre</td></tr>";
        }
        ?>
    </table>
    <a href="genres.php">Back to Genres</a>
</body>
</html>

<?php
$db->close();
?>
