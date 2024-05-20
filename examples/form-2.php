<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>To jest mały test...</title>
</head><body>
<?php
if (!isset($_POST["submit"]))
{
    ?>
    <h1>Czyje zajęcia lubisz najbardziej</h1>

    <p>Na studiach podyplomowych?
    <form action="form-2.php" method="POST">
    <input type="checkbox" name="person[]" value="prof. Tomasz Szmuc">prof. Tomasz Szmuc<br>
    <input type="checkbox" name="person[]" value="dr Radosław Klimek">dr Radosław Klimek<br>
    <input type="checkbox" name="person[]" value="dr Grzegorz Rogus">dr Grzegorz Rogus<br>
    <input type="checkbox" name="person[]" value="dr Krzysztof Kluza">dr Krzysztof Kluza<br>
    <br>
    <input type="submit" name="submit" value="Wybierz">
    </form>
    <p>
    <?php
    }
else
{
    ?>
    <h1>Wybrałeś:</h1>
    <br>
    <?php
     if(!empty($_POST['person'])) {
         foreach($_POST['person'] as $person)
         {
           echo "<i>$person</i><br>";
           switch ( $person ) {
           case "prof. Tomasz Szmuc":
             $TSZ=true;
             break;
           case "dr Krzysztof Kluza":
             $KKL=true;
             break;
           } 
         }
         if ( $KKL==true )
            echo ("<br><b>BRAWO!</b>");
      }
      else
        echo "Nie wybrales nikogo...";
}
?>
<p><hr><br>
<a href="intro.php">Powrót do głównego dokumentu</a>
</body>
</html>