<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<title>To jest formularz w PHP do czytania z MySQL</title>
</head><body>

<h1>Prosze wprowadzic parametry bazy i zapytania</h1>
<p><center>
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
uzytkownik:	
<input type="text" name="suser" size="10" value="<?= isset($suser) ? $suser : '' ?>">&nbsp;
serwer:	
<input type="text" name="sserver" size="15" value="localhost"><br>
baza:
<input type="text" name="sdbase" size="10" value="<?= isset($sdbase) ? $sdbase : '' ?>">&nbsp;
haslo:
<input type="password" name="spass" size="10" value="<?= isset($spass) ? $spass : '' ?>">&nbsp;

<br>zapytanie:	
<br><textarea name="squery" rows="1" cols="60" wrap="physical">
    SELECT version();
</textarea><br>
<br><input type="submit" value="ZAPYTAJ">
</center></p>

<?php

if (isset($_POST['squery'])) {
    if (!isset($_POST['suser'])) {
        echo "<hr><h1>Brak poprzedniego zapytania</h1>";
        echo "<hr><a href=\"index.php\">
                     Powrot do strony glownej</a>";
        exit;
    }    
    
    $sserver = $_POST['sserver'];
    $suser = $_POST['suser'];
    $sdbase = $_POST['sdbase'];
    $spass = $_POST['spass'];
    
    // Build MySQL connection string
    $db = new mysqli($sserver, $suser, $spass, $sdbase);
    if ($db->connect_error) {
        echo "<hr>An error occurred! <br/>";
        echo "Error: " . $db->connect_error;
        exit;
    }
    
    $today = date("G:i:s, j-n-Y");
    echo "<hr><h1><b>Wynik zapytania z $today</h1>";
    echo "<h2>Baza: \"<i>$sdbase</i>\"</h2>";
    
    $query = $_POST['squery'];
    $result = $db->query($query);
    if (!$result) {
        echo "An error occurred.\n";
        echo "Error: " . $db->error;
        exit;
    }
    
    echo "<h2>Zapytanie: \"<i>$query</i>\"</h2>";
    echo "<h3>Wynik zapytania w tabeli z nazwami i typami pol</h3>";
    echo "<p><table><tbody>";
    
    // Display query results
    $fields = $result->fetch_fields();
    echo "<tr><td><b>Rekord</b>";
    foreach ($fields as $field) {
        echo "<td><b>{$field->name}</b> (<i>{$field->type}</i>)";
    }
    
    $i = 0;
    while ($row = $result->fetch_row()) {
        $i++;
        echo "<tr><td>$i";
        foreach ($row as $value) {
            echo "<td>$value";
        }
        echo "</tr>";
    }
    
    echo "</tbody></table><hr>";
    
    $result->free();
    $db->close();
    echo "<hr><a href=\"index.php\">
             Powrot do strony glownej</a>";
}
?>
</body></html>
