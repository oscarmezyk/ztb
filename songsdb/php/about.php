<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="adminlogin.php">Admin</a>
        <a href="about.php">About</a>
    </div>
    <div class="header">
        <h2>About Us</h2>
    </div>
    <div class="content">
        <div class="card">
            <p>Ta strona została stworzona przez zespół:</p>
            <div><strong>Wojciech Godzicki</strong> - Konfiguracja bazy danych na serwerze AGH, rozwój backendu</div>
            <div><strong>Oskar</strong> - Tworzenie kodu PHP i konfiguracja serwera na stronie AGH, rozwój backendu</div>
            <div><strong>Sebastian</strong> - Rozwój backendu i frontendu</div>
            <div><strong>Adela Hopek</strong> - Rozwój frontendu</div>
        </div>
    </div>
    <h2>O serwisie</h2>
    <div class="content">
        <div class="card">
            <p>Serwis jest platformą muzyczną, która zarządza informacjami o użytkownikach, piosenkach, zespołach, gatunkach muzycznych oraz ulubionych utworach. Oto główne funkcje serwisu:</p>
            
            <h3>Użytkownicy (users)</h3>
            <p>Przechowuje dane o użytkownikach: nazwa użytkownika, email i hasło. Każdy użytkownik ma unikalne ID.</p>
            
            <h3>Ulubione (favourites)</h3>
            <p>Przechowuje informacje o ulubionych utworach użytkowników. Powiązane z tabelami users i songs za pomocą kluczy obcych (user_id i song_id).</p>
            
            <h3>Gatunki muzyczne (genres)</h3>
            <p>Przechowuje dane o gatunkach muzycznych (nazwa gatunku). Każdy gatunek ma unikalne ID.</p>
            
            <h3>Piosenki (songs)</h3>
            <p>Przechowuje informacje o piosenkach: tytuł, rok, czas trwania i powiązane gatunki oraz zespoły. Powiązane z tabelami bands i genres za pomocą kluczy obcych (band_id i genre_id).</p>
            
            <h3>Zespoły (bands)</h3>
            <p>Przechowuje dane o zespołach: nazwa zespołu, kraj pochodzenia i liczba członków. Każdy zespół ma unikalne ID.</p>
            </div>
    </div>
    <h2>Funkcjonalności serwisu</h2>
        <div class="content">
        <div class="card">    
            
            <ul>
                <p>Rejestracja i logowanie użytkowników: Umożliwia użytkownikom tworzenie konta, logowanie się i zarządzanie swoim profilem.</p>
                <p>Zarządzanie ulubionymi utworami: Użytkownicy mogą dodawać piosenki do swojej listy ulubionych.</p>
                <p>Eksploracja muzyki: Użytkownicy mogą przeglądać piosenki według zespołów i gatunków.</p>
                <p>Informacje o zespołach i gatunkach: Serwis zapewnia szczegółowe informacje o zespołach i gatunkach muzycznych.</p>
            </ul>
            <p>Serwis jest przydatny dla miłośników muzyki, którzy chcą odkrywać nowe utwory, zarządzać swoimi ulubionymi i poznawać informacje o zespołach oraz gatunkach muzycznych.</p>
        </div>
    </div>
    <h2>Diagram bazy danych</h2>
    <div class="content">
        <div class="card">
            
            <img src="images/diagram.png" alt="Database Diagram">
        </div>
    </div>
</body>
</html>
