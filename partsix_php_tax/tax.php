<?php

$employeeName = "Kevin Slonka";
$hoursWorked = 40;
$formattedHoursWorked = number_format($hoursWorked, 1, '.', '');
$payRate = 54.5;
$formattedPayRate = number_format($payRate, 2, '.', '');
$grossPay = $hoursWorked * $payRate;
$grossAnnualPay = $grossPay * 52;

if ($grossAnnualPay >= 0 && $grossAnnualPay <= 11925)
	$federalTaxWithholdingRate = 10;
else if ($grossAnnualPay > 11925 && $grossAnnualPay <= 48475)
        $federalTaxWithholdingRate = 12;
else if ($grossAnnualPay > 48476 && $grossAnnualPay <= 103350)
        $federalTaxWithholdingRate = 22;
else if ($grossAnnualPay > 103350 && $grossAnnualPay <= 197300)
        $federalTaxWithholdingRate = 24;
else if ($grossAnnualPay > 197300 && $grossAnnualPay <= 250525)
        $federalTaxWithholdingRate = 32;
else if ($grossAnnualPay > 250525 && $grossAnnualPay <= 626350)
        $federalTaxWithholdingRate = 35;
else if ($grossAnnualPay > 626350)
        $federalTaxWithholdingRate = 37;
else
	$federalTaxWithholdingRate = 0;

$stateTaxWithholdingRate = 5.5;

$formattedGrossPay = number_format($grossPay, 2, '.', '');
$federalWithholding = $grossPay * $federalTaxWithholdingRate / 100;
$formattedFederalWithholding = number_format($federalWithholding, 2, '.', '');
$stateWithholding = $grossPay * $stateTaxWithholdingRate / 100;
$formattedStateWithholding = number_format($stateWithholding, 2, '.', '');
$totalDeduction = $federalWithholding + $stateWithholding;
$formattedTotalDeduction = number_format($totalDeduction, 2, '.', '');
$netPay = $grossPay - $totalDeduction;
$formattedNetPay = number_format($netPay, 2, '.', '');

$out = <<<_END
<!DOCTYPE html>
<html>
<head>
	<title>PHP Tax Calculator</title>
</head>
<body>
	<h1>PHP Tax Calculator</h1>
	<table border="1">
		<tr>
			<th>Employee Name</th>
			<td>$employeeName</td>
		</tr>
		<tr>
			<th>Hours Worked</th>
			<td>$formattedHoursWorked</td>
		</tr>
		<tr>
			<th>Pay Rate</th>
			<td>$$formattedPayRate</td>
		</tr>
		<tr>
			<th>Gross Pay</th>
			<td>$$formattedGrossPay</td>
		</tr>
		<tr>
			<th colspan="2">Deductions</th>
		</tr>
		<tr>
			<th>Federal Withholding ($federalTaxWithholdingRate%)</th>
			<td>$$formattedFederalWithholding</td>
		</tr>
		<tr>
			<th>State Withholding ($stateTaxWithholdingRate%)</th>
			<td>$$formattedStateWithholding</td>
		</tr>
		<tr>
			<th colspan = "2">Total Deduction</th>
		</tr>
		<tr>
			<td colspan = "2" style="text-align: center;">$$formattedTotalDeduction</td>
		</tr>
		<tr>
			<th colspan = "2">Net Pay</th>
		</tr>
		<tr>
			<td colspan = "2" style="text-align: center;">$$formattedNetPay</td>
		</tr>
		<tr>
                        <th colspan = "2">Tax Bracket</th>
                </tr>
                <tr>
                        <td colspan = "2" style="text-align: center;">$federalTaxWithholdingRate%</td>
                </tr>
	</table>
</body>
</html>
_END;
echo $out;

?>
