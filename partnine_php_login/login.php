<?php

session_start();

$error = "";

function sanitizeInput($in)
{
	return preg_replace("/[^A-Za-z0-9]/", "", $in);
}

if (isset($_GET['action']) && $_GET['action'] == "logout")
{
	session_destroy();
	header("Location: login.php");
	exit();
}

if (isset($_POST['user']))
{
	$username = sanitizeInput($_POST['user']);
	$password = sanitizeInput($_POST['password']);

	if ($username == "admin" && $password == "password")
	{
		$_SESSION['status'] = "loggedin";
		$_SESSION['username'] = $username;
	}
	else
	{
		$_SESSION['error'] = "Invalid login...";
		header("Location: login.php");
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Chapter 13</title>
</head>
<body>
<?php
	if(isset($_SESSION['status']) && $_SESSION['status'] == "loggedin")
	{
?>
		<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
		<p><a href = "login.php?action=logout">Logout</a></p>
<?php
	}
	else
	{
		if (isset($_SESSION['error']))
		{
			echo "<p>" . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}
?>
		<form action="login.php" method="POST">
			<p>Username: <input type="text" name="user"/></p>
			<p>Password: <input type="password" name="password"/></p>
			<button type="submit">Login</button>
		</form>
<?php
	}
?>
</body>
</html>
