<?php
    session_start();

    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Variable declaration
    $username = "";
    $email    = "";
    $errors = array(); 
    $_SESSION['success'] = "";

    // Connect to the database
    $db = mysqli_connect('mysql.agh.edu.pl', 'wgrodzi1', 'LCUseesUrffV5sbq', 'wgrodzi1', '3306');

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if user exists function
    function checkUserExists($db, $user) {
        $query = "SELECT * FROM users WHERE username='$user'";
        $result = mysqli_query($db, $query);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    // Register user
    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
        if (checkUserExists($db, $username)) {
            array_push($errors, "User already exists!");
        }

        if (count($errors) == 0) {
            $password = md5($password_1); // Encrypt the password before saving in the database
            $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
            mysqli_query($db, $query);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }

    // Login user
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if (!checkUserExists($db, $username)) {
            array_push($errors, "No such user!");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);

            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>
