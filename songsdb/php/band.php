
<?php include('server.php') ?>

<?php

$band_id = intval($_GET['band_id']);
$sql = "SELECT songs.title, genres.name AS genre_name FROM songs 
        JOIN genres ON songs.genre_id = genres.id 
        WHERE songs.band_id = $band_id";
$result = $db->query($sql);

$sql_band = "SELECT name FROM bands WHERE id = $band_id";
$band_result = $db->query($sql_band);
$band = $band_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Songs by <?php echo $band['name']; ?></title>
    <style>
        table { width: 70%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Songs by <?php echo $band['name']; ?></h1>
    <table>
        <tr>
            <th>Song Title</th>
            <th>Genre</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['genre_name'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No songs found for this band</td></tr>";
        }
        ?>
    </table>
    <a href="genres.php">Back to Genres</a>
</body>
</html>

<?php
$db->close();
?>
