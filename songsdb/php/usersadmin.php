<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Dodane style dla checkboxów */
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            float: left;
            margin-right: 10px;
        }
        
        /* Styl dla checkboxów wewnątrz klasy user-form */
        .user-form input[type="checkbox"] {
            clear: left; /* Rozpoczyna nowy wiersz dla checkboxów */
        }
    </style>
</head>
<body>
    <div class="navbar">
    <a href="admin_panel.php">Home</a>
        <a href="usersadmin.php">Users</a>
        <a href="songsadmin.php">Songs</a>
        <a href="index.php">Logout</a>
    </div>
    <div class="content">
        <h2>Admin Panel</h2>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="Search for users...">
        </div>
        <div class="user-form">
            <form action="delete_user.php" method="post">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "pageusers";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='user'>
                                  <input type='checkbox' name='selected_users[]' value='" . $row['username'] . "'>
                                  <label for='" . $row['username'] . "'>" . $row['username'] . "</label>
                              </div>";
                    }
                } else {
                    echo "No users found";
                }

                $conn->close();
                ?>
                <br>
                <input type="submit" value="Delete Selected Users">
            </form>
        </div>
    </div>

    <script>
        function searchUsers() {
            // Pobierz wartość wpisaną przez użytkownika w polu wyszukiwania
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var users = document.getElementsByClassName("user");

            // Iteruj przez wszystkich użytkowników i ukryj tych, którzy nie pasują do wyszukiwanej frazy
            for (var i = 0; i < users.length; i++) {
                var username = users[i].getElementsByTagName("label")[0];
                var txtValue = username.textContent || username.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    users[i].style.display = "";
                } else {
                    users[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
