<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
	<html><head>
	<title>To jest formularz w PHP do czytania z PqSQL</title>
	</head><body>

    <h1>Prosze wprowadzic parametry bazy i zapytania</h1>
    <p><center>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
	uzytkownik:	
	<input type="text" name="suser" size="10" value="<?= $suser ?>">&nbsp;
	serwer:	
	<input type="text" name="sserver" size="15" value="localhost"><br>
	baza:
	<input type="text" name="sdbase" size="10" value="<?= $sdbase ?>">&nbsp;
	haslo:
	<input type="password" name="spass" size="10" value="<?= $spass ?>">&nbsp;
	
	<br>zapytanie:	
	<br><textarea name="squery" rows="1" cols="60" wrap="physical">
        SELECT version();</textarea><br>
	<br><input type="submit" value="ZAPYTAJ">
	</center></p>
	
	<?php

if (isset($_POST['squery'])) {
      if (!isset($_POST['suser']) ) {
	      echo "<hr><h1>Brak poprzedniego zapytania</h1>";
	      echo "<hr><a href=\"index.php\">
		               Powrot do strony glownej</a>";
	      exit;
      }    
        
    $sserver = $_POST['sserver'];
    $suser = $_POST['suser'];
    $sdbase = $_POST['sdbase'];
    $spass = $_POST['spass'];
        
    if (!isset($_POST['sdbase']) ) {    
        $db = "host=$sserver port=5432 user=$suser";
    }
    else {
        $db = "host=$sserver port=5432 user=$suser dbname=$sdbase";
    }
    
    $conn = pg_connect ("$db"." password=$spass");
    if (!$conn) {
	    echo "<hr>An error occured! <br/>\$db: ($db)\n";
	    echo pg_last_error($conn);
	    exit;
    }
    
    $today = date ("G:i:s, j-n-Y");
    echo "<hr><h1><b>Wynik zapytania z $today</h1>";
    echo "<h2>Baza: \"<i>$db</i>\"</h2>";
    
    $query = $_POST['squery'];
    $result = pg_query ($conn, "$query");
    if (!$result) {
	    echo "An error occured.\n";
	    echo pg_result_error($result);
	    exit;
    }
    echo "<h2>Zapytanie: \"<i>$query</i>\"</h2>";
    
    echo "<h3>Wynik zapytania w tabeli z nazwami i typami pol</h3>";
    echo "<p><table><tbody>";
    
    $fie = pg_num_fields($result);
    echo "<tr><td><b>Rekord</b>";
    for ($i=0; $i < $fie; $i++) {
	    $r = pg_field_name ($result,$i);
	    $t = pg_field_type ($result,$i);
	    echo "<td> <b>$r</b> (<i>$t</i>)";
    }
    $num = pg_num_rows($result);
    for ($i=0; $i < $num; $i++) {
	    echo "<tr><td>$i";
	    $r = pg_fetch_row($result, $i);
	        for ($j=0; $j < count($r); $j++) {
		                echo "<td> $r[$j]";
		}
	    echo "</tr>";
    }
    echo "</tbody></table><hr>";
    
    pg_free_result($result);
    pg_close($conn);
    echo "<hr><a href=\"index.php\">
	         Powrot do strony glownej</a>";
}
?>
</body></html>