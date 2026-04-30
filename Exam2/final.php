<?php
	session_start();
	$error = "";

	function sanitizeInput($in)
	{
		return preg_replace("/[^A-Za-z0-9]/", "", $in);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user']))
	{
		$username = sanitizeInput($_POST['user']);
		$password = sanitizeInput($_POST['password']);

		$file = fopen("auth.db", "r");
		$login = false;
    		while (($line = fgets($file)) !== false)
		{
        		list($authuser, $authpassword) = explode("\t", trim($line));
			if ($authuser === $username && $authpassword === $password)
			{
				$_SESSION['status'] = "loggedin";
				$_SESSION['user'] = $username;
				$login = true;
				break;
        		}
    		}
    		fclose($file);
		if (!$login)
		{
			$_SESSION['error'] = "Invalid login...";
			header("Location: final.php");
			exit();
		}
	}
?>
<html>
<head>
        <title>CPSC222 Final Exam</title>
</head>
<body>
        <h1>CPSC222 Final Exam</h1>
<?php
	if (isset($_SESSION['status']) && $_SESSION['status'] == "loggedin")
	{
		echo "<h3>Welcome, " . $_SESSION['user'] . "! (<a href='final_logout.php'>Log Out</a>)</h3>";

		if (isset($_GET['page']))
		{

			echo "<p><a href='final.php'>&lt; Back to Dashboard</a></p>";

			$page = sanitizeInput($_GET['page']);
			if ($page === "1")
			{
				echo "<h4>User list</h4>";
				echo "<table border='1'>";
				echo "<tr><th>Username</th><th>Password</th><th>UID</th><th>GID</th><th>Display Name</th><th>Home Directory</th><th>Default Shell</th></tr>";
				$passwd = file("/etc/passwd");
				foreach ($passwd as $line)
				{
					$fields = explode(":", $line);
					echo "<tr>";
					foreach ($fields as $field)
					{
						echo "<td>$field</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			else if ($page === "2")
			{
				echo "<h4>Group list</h4>";
				echo "<table border='1'>";
				echo "<tr><th>Group Name</th><th>Password</th><th>GID</th><th>Members</th></tr>";
				$group = file("/etc/group");
				foreach ($group as $line)
				{
					$fields = explode(":", $line);
					echo "<tr>";
					foreach ($fields as $field)
					{
						echo "<td>$field</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			else if ($page === "3")
                   	{
				echo "<h4>Syslog</h4>";
				echo "<table border='1'>";
				echo "<tr><th>Date</th><th>Hostname</th><th>Application[PID]</th><th>Message</th></tr>";
				$syslog = file("/var/log/syslog");
				foreach ($syslog as $line)
				{
					$fields = explode(' ', $line, 4);
					echo "<tr>";
					foreach ($fields as $field)
					{
						if ($field == $fields[0])
						{
							$date = new DateTime($field);
							date_default_timezone_set('America/New_York');
							$field = $date->format('M d H:i:s');
						}
						echo "<td>$field</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
                        }
			else
			{
				echo "<p>Invalid page</p>";
			}
		}
		else
		{
?>
			<p>Dashboard:</p>
			<ul>
				<li><a href='final.php?page=1'>User list</a></li>
				<li><a href='final.php?page=2'>Group list</a></li>
				<li><a href='final.php?page=3'>Syslog</a></li>
			</ul>
<?php
		}
	}
	else
	{
		if (isset($_SESSION['error']))
		{
			echo "<p>" . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}
?>
		<form action="final.php" method="POST">
			<p>Username: <input type="text" name="user"/></p>
			<p>Password: <input type="password" name="password"/></p>
			<button type="submit">Login</button>
		</form>
<?php
	}
?>
</body>
<footer style="border-top: 2px solid gray">
	<?php date_default_timezone_set('America/New_York'); echo date("Y-m-d h:i:s A");?>
</footer>
</html>
