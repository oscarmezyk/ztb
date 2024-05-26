<?php
session_start();

// Połączenie z bazą danych
$servername = "mysql.agh.edu.pl";
$username = "wgrodzi1";
$password = "LCUseesUrffV5sbq";
$database = "wgrodzi1";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obsługa logowania
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Pobranie danych użytkownika z bazy danych
    $sql = "SELECT * FROM admin_users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Ustawienie danych sesji
        $_SESSION['username'] = $row['username'];
        // Przekierowanie do odpowiedniej strony
        header("Location: admin_panel.php");
        exit();
    } else {
        // Komunikat o błędnym haśle lub nazwie użytkownika
        $login_message = "Invalid username or password.";
    }
}

// Zamykanie połączenia z bazą danych
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login</title>
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
    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
            <h2>Admin login</h2>
            <input type="text" name="username" placeholder="Operator name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
            <?php if (!empty($login_message)): ?>
                <p class="login-message"><?php echo $login_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
