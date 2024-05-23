<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<script src="canvasjs.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>

	<div id="content_id" class="content">
	<?php
		
		$query = "SELECT genres.id, genres.name, (SELECT count(*) FROM songs WHERE songs.genre_id=genres.id) AS count FROM genres;";
		$result = $db->query($query);

		$datapoints = array();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$dataPoints[] = array("id" => $row['id'], "label" => $row['name'], "y" => $row['count']);
			}
		}

		$result->free();
		$db->close();
		echo "<center><b><a href=\"index.php\">Zaloguj lub zarejestruj się!</a></b></center>";
	?>
	</div>

    <div id="chartContainer" class="content" style="height: 370px; width: 80%;"></div>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Pie Chart from Database"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "##0",
                    indexLabel: "{label} {y}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</body>

</body>
</html>