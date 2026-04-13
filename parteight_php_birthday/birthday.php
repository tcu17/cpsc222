<?php

echo "<title>PHP Birthday Formatter</title>";
echo "<h1>Birthday Formatter</h1>";

function sanitizeString($var)
{
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

if (isset($_GET['page_iso']))
{
	$date = htmlspecialchars($_GET['page_iso']);
	echo "<p>$date</p>";
}
elseif(isset($_POST['submit']))
{
	$mo = sanitizeString($_POST['month']);
	$d = (int)$_POST['day'];
	$y = (int)$_POST['year'];
	$h = (int)$_POST['hour'];
	$mi = str_pad((int)$_POST['minute'], 2, '0', STR_PAD_LEFT);
	$ampm = sanitizeString($_POST['ampm']);

	$dateString = "$mo $d $y $h:$mi $ampm";
	$date = DateTime::createFromFormat('F j Y g:i A', $dateString);

	if($date)
	{
		echo "<p>" . $date->format('l F jS, Y - g:ia') . "</p>";

		$isoDate = $date->format('Y-m-d H:i:s');
		echo "<p><a href='birthday.php?page_iso=" . urlencode($isoDate) . "'>Show date in ISO format</a></p>";
	}
}
else
{
?>

<!DOCTYPE html>
<html>
<body>
	<form method="POST" action="birthday.php"><table border="5">
		<tr>
			<th>Month</th>
			<th>Day</th>
			<th>Year</th>
			<th>Hour</th>
			<th>Minute</th>
			<th>AM/PM</th>
		</tr>
		<tr align="center">
			<td><select name="month">
				<option value="January">January</option>
				<option value="February">February</option>
				<option value="March">March</option>
				<option value="April">April</option>
				<option value="May">May</option>
				<option value="June">June</option>
				<option value="July">July</option>
				<option value="August">August</option>
				<option value="September">September</option>
				<option value="October">October</option>
				<option value="November">November</option>
				<option value="December">December</option>
			</select></td>
			<td><select name="day">
				<?php
					for($d = 1; $d <= 31; $d++)
					{
						echo "<option value='$d'>$d</option>";
					}
				?>
			</select></td>
			<td><select name="year">
				<?php
					for($y = date("Y"); $y >= (date("Y") - 120); $y--)
					{
						echo "<option value='$y'>$y</option>";
					}
				?>
			</select></td>
			<td><select name="hour">
                                <?php
                                        for($h = 1; $h <= 12; $h++)
                                        {
                                                echo "<option value='$h'>$h</option>";
                                        }
                                ?>
                        </select></td>
			<td><select name="minute">
                                <?php
                                        for($mi = 0; $mi <= 59; $mi++)
                                        {
                                                echo "<option value='$m'>" . str_pad($mi, 2, '0', STR_PAD_LEFT) . "</option>";
                                        }
                                ?>
                        </select></td>
			<td><select name="ampm">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="6" align="center"><button type="submit" name="submit">Format Date</button></td>
		</tr>
	</table></form>
</body>
<?php
}
?>
