<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'root') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pageusers";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sprawdzamy, czy jakiekolwiek użytkownicy zostali zaznaczeni
    if(isset($_POST['selected_users'])) {
        // Iterujemy przez zaznaczonych użytkowników i usuwamy ich
        foreach($_POST['selected_users'] as $selected_user) {
            $sql = "DELETE FROM users WHERE username='$selected_user'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error deleting user: " . $conn->error;
                // W razie błędu można przerwać iterację lub podjąć inne działania
            }
        }
        echo "Selected users deleted successfully";
    } else {
        echo "No users selected for deletion";
    }

    $conn->close();

    // Przekierowanie z powrotem do usersadmin.php
    header("Location: usersadmin.php");
    exit(); // Upewniamy się, że przekierowanie jest wykonane, a skrypt nie kontynuuje działania
}
?>
