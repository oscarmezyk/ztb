<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST)) {
            echo '<ul>';
            foreach ($_POST as $key => $value) {
                echo '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No POST data received.</p>';
        }
    } 
?>
<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL);

	function checkUserExists($db, $user){
		$query = "SELECT * FROM users WHERE username='$user'";
		$result = mysqli_query($db, $query);
		if ($result->num_rows > 0) {return True;}
		return False;
	}

	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('mysql.agh.edu.pl', 'wgrodzi1', 'LCUseesUrffV5sbq', 'wgrodzi1', '3306');

	// GET NOUSER DATA
	if (isset($_POST['nouser'])) {
		$_SESSION['nouser'] = True;
	}

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if(checkUserExists($db,$username)) { array_push($errors, "User already exists!");}

		// register user if there are no errors in the form
		if (count($errors) == 0 ) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			$_SESSION['nouser'] = "";
			header('location: index.php');
		}

	}
		

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if(!checkUserExists($db,$username)) { array_push($errors, "No such user!");}
		
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				$_SESSION['nouser'] = "";

				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
?>
