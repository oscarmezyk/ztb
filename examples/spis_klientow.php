<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
	<html><head>
	<meta charset="UTF-8">
	<title>To jestskrypt w PHP do czytania z PqSQL</title>
	</head><body>

	<?php

$pass=''; # tu wstawic haslo
$uname=''; # tu wstawic nazwe uzytkownika
$dbname=''; # tu wstawic nazwe bazy

if (!isset($pass)) {
    echo "<br><b>Ustaw lokalnie haslo w pliku PHP!</b>";
    exit;
}
$db = "host=127.0.0.1 user=$uname dbname=$dbname";
$conn = pg_connect ("$db"." password=$pass");
if (!$conn) {
    echo "<hr>An error occured!, (\$db=$db)\n";
	    echo pg_result_error($conn);
	    exit;
    }
    
$today = date ("G:i:s, j-n-Y");
echo "<hr><h1><b>Wynik zapytania z $today</h1>\n";
echo "<h2>Baza: \"<i>$db</i>\"</h2>\n";

$query = "select * from klienci;";
$result = pg_query ($conn, "$query");
if (!$result) {
    echo "An error occured.\n";
    echo pg_result_error($result);
    exit;
}
echo "<h2>Zapytanie: \"<i>$query</i>\"</h2>\n";

echo "<h3>Lista klientów</h3>\n\n";
echo "<table><tbody>\n";

$fie = pg_num_fields($result);
echo "<tr><td><b>Rekord</b>\n";
for ($i=0; $i < $fie; $i++) {
    $r = pg_field_name ($result,$i);
    $t = pg_field_type ($result,$i);
    echo "<td> <b>$r</b> (<i>$t</i>)</b>";
}
$num = pg_num_rows($result);
for ($i=0; $i < $num; $i++) {
    echo "<tr><td>$i";
	    $r = pg_fetch_row($result, $i);
	        for ($j=0; $j < count($r); $j++) {
		                echo "<td> $r[$j]";
		}
	    echo "</tr>\n";
}
echo "</tbody></table>\n";

pg_free_result($result);
pg_close($conn);
?>