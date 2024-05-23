<?php include('server.php') ?>
<?php

$sql = "SELECT * FROM genres";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Genres</title>
    <style>
        table { width: 50%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Genres</h1>
    <table>
        <tr>
            <th>Genre</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td><a href='songs.php?genre_id=" . $row['id'] . "'>" . $row['name'] . "</a></td></tr>";
            }
        } else {
            echo "<tr><td>No genres found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$db->close();
?>
