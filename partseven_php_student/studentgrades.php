<?php

require_once('student.php');
require_once('grades.php');

$students = array
(
	new Student("Kevin", "Slonka", 1001, array("CPSC222" => 98, "CPSC111" => 76, "CPSC333" => 82)),
	new Student("Joe", "Schmoe", 1005, array("CPSC122" => 88, "CPSC411" => 46, "CPSC323" => 72)),
	new Student("Stewie", "Griffin", 1009, array("CPSC244" => 68, "CPSC116" => 96, "CPSC345" => 82))
);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Grades</title>
</head>

<body>
	<h1>Chapters 5 & 6</h1>

	<?php for($i = 0; $i < count($students); $i++)
	{ 

		$student = $students[$i];?>
		<table border="5">
			<tr>
				<th>Name</th>
				<td><?php echo $student->getLastName() . ', ' . $student->getFirstName(); ?></td>

			</tr>
			<tr>
				<th>Student ID</th>
				<td><?php echo $student->getStudentID(); ?></td>
			</tr>
			<tr>
				<th>Grades</th>
				<td>
					<ul>
						<?php
						foreach($student->getCourses() as $course => $grade)
						{ ?>
							<li><?php echo $course . ' - ' . $grade . ' ' . getLetterGrade($grade); ?></li>
						<?php } ?>
					</ul>
				</td>
			</tr>
		</table>
	<?php } ?>
</body>
</html>
