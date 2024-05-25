<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
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
        <?php
        session_start();
        $login_successful = false;
        $login_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "pageusers";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user = $_POST['username'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM users WHERE username='$user'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($user === 'root' && $pass === 'root') {
                    // Logowanie jako admin
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['id'];
                    if ($row['username'] === 'admin') {
                        header("Location: admin_panel.php");
                    } else {
                        header("Location: songs.php");
                    }
                    exit();
                } elseif (password_verify($pass, $row['password'])) {
                    // Zwykłe logowanie
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: songs.php");
                    exit();
                } else {
                    $login_message = "Invalid password.";
                }
            } else {
                $login_message = "No user found with that username.";
            }

            $conn->close();
        }
        ?>

        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
            <?php if (!empty($login_message)): ?>
                <p><?php echo $login_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
