<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        
        <a href="songs.php">Songs</a>
        <a href="cart.php">Cart</a>
        <a href="index.php">Logout</a>
        <a href="about.php">About</a>
       
    </div>
    <div class="content">
        <h2>Your Cart</h2>
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit();
        }

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "pageusers";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $song_ids = implode(',', $_SESSION['cart']);
            $sql = "SELECT * FROM songs WHERE id IN ($song_ids)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul class='cart-list'>";
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['song_name'] . " - " . $row['artist'] . " <a href='remove_from_cart.php?song_id=" . $row['id'] . "'>Remove</a></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No songs in the cart</p>";
            }

            $conn->close();
        } else {
            echo "<p>Your cart is empty</p>";
        }
        ?>
    </div>
</body>
</html>
