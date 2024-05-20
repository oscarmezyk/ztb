<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>To jest strona o PHP5</title>
</head><body>
 
<?php
 
ini_set('display_errors', 'on');
error_reporting(E_ALL);
 
$imie = "Krzys";
if ( isset($_GET["sh"]) && ($_GET["sh"] == "true") ) {
    $script = $_SERVER['SCRIPT_FILENAME'];
    echo "script $script";
    if(!isset($script)) {
        echo "<BR><B>BŁĄD: Muszę mieć nazwę pliku!</B><BR>";
        phpinfo();
    } else {
        if (preg_match("/php$/i", $script)) {
	        $pinfo=basename($script);
            echo "<H1>Kod źródłowy pliku: $pinfo</H1>\n<HR>\n";
            highlight_file($script);
        } else {
            echo "<H1>BŁĄD: umiem tylko PHP!</H1>";
        }
    }
    echo "Przetworzono: ".date("Y/M/d H:i:s",time());
    echo "<hr>";
}
 
if ( $_POST["fname"] or $_POST["lname"] ) {
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$memo=$_POST["memo"];
 
    echo "
<h1> Ajajaj! Ktoś nas wywołał z formularza!</h1>
<p>Napisał, że nazywa się: $fname $lname i chce nam powiedzieć: \"$memo\"";
    if ($memo == "NIC!")
        echo " (ale on jest leniwy!)";
} 
 
echo"<h1>Oto $imie uczy (się:)) PHP</h1>";
 
// FOR
$n = 5;
echo "
<h2>To jest pętla <tt>for</tt>, która ma $n iteracji</h2><p><ul>";
for ($i=1; $i<=$n; $i++) {
  echo "<li> element numer $i";
 
}
echo "</ul>";
?>
 
<h1>Tutaj mamy kilka ładnych przykładów...</h1>
<p>Kliknij <a href="intro.php?sh=true">tutaj</a> żeby zobaczyć kod tego pliku.
 
<p>Kilka dodatkowych plików:<ul>
<li><a href="info.php">informacje z <i>phpinfo()</i></a>
<li><a href="form-1.php">prosty formularz</a>
<li><a href="form-2.php">nieco inny formularz</a>
</ul>
 
</body></html>