<?php
session_start();
include("../Backend/Database/connection.php");

$empId = $_SESSION['EmployeeId'];

// Fetch employee data
$query = "SELECT * FROM tbladdemployee WHERE Emp_Id = '$empId'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error in employee query: " . mysqli_error($conn));
}

if ($row = mysqli_fetch_assoc($result)) {
    $firstName = $row["First_Name"];
    $lastName = $row["Last_Name"];
    $department = $row["Department"];
} else {
    die("No employee found with this ID.");
}

// Set default selected month and year to the current month and year
$selectedMonth = isset($_POST['month']) ? $_POST['month'] : date('F'); // e.g., 'September'
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y'); // e.g., '2024'

// Fetch salary data for the selected month and year
$query = "SELECT * FROM salaries WHERE employee_id = '$empId' AND MONTHNAME(month_year) = '$selectedMonth' AND YEAR(month_year) = '$selectedYear'";
$salaryResult = mysqli_query($conn, $query);

if (!$salaryResult) {
    die("Error in salary query: " . mysqli_error($conn));
}

if ($salaryRow = mysqli_fetch_assoc($salaryResult)) {
    $totalSalary = $salaryRow['total_salary'];
    $hra = $salaryRow['hra'];
    $da = $salaryRow['da'];
    $pf = $salaryRow['pf'];
    $totalPresentDays = $salaryRow['total_present_days'];
    $totalAbsentDays = $salaryRow['total_absent_days'];
    $totalEarnings = $totalSalary + $hra + $da;
    $totalDeductions = $pf;
    $netSalary = $totalEarnings - $totalDeductions;
    $salaryDate = "$selectedMonth $selectedYear";
} else {
    $noSalaryDataMessage = "No salary data found for this employee for the selected month and year.";
}

// Fetch available months and years for salary slips
$availableMonthsQuery = "SELECT DISTINCT MONTHNAME(month_year) AS month, YEAR(month_year) AS year FROM salaries WHERE employee_id = '$empId'";
$availableMonthsResult = mysqli_query($conn, $availableMonthsQuery);
$availableMonths = [];

while ($monthRow = mysqli_fetch_assoc($availableMonthsResult)) {
    $availableMonths[] = $monthRow['month'] . ' ' . $monthRow['year'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/salary_slip.css">
    <link rel="icon" type="image/png" href="image/favicon.png">
    <title>Salary Slip</title>
</head>
<body>
    <div class="container">
        <h3>Select Month and Year</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="month">Month:</label>
                <select name="month" id="month" class="form-control">
                    <?php
                    foreach (range(1, 12) as $m) {
                        $monthName = date('F', mktime(0, 0, 0, $m, 1)); // Get month name from number
                        echo "<option value='$monthName' " . ($selectedMonth == $monthName ? 'selected' : '') . ">$monthName</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <select name="year" id="year" class="form-control">
                    <?php
                    for ($year = date('Y'); $year >= date('Y') - 5; $year--) {
                        echo "<option value='$year' " . ($selectedYear == $year ? 'selected' : '') . ">$year</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">View Salary Slip</button>
        </form>

        <?php if (isset($noSalaryDataMessage)) { ?>
            <p class="alert alert-warning mt-3"><?php echo $noSalaryDataMessage; ?></p>
        <?php } else { ?>
            <div id="salary-slip" class="salary-slip mt-5">
                <h3>Salary Slip for <?php echo $salaryDate; ?></h3>
                <div class="employee-details row">
                    <div class="col-md-6">
                        <p><strong>Employee ID:</strong> <?php echo $empId; ?></p>
                        <p><strong>Name:</strong> <?php echo $firstName . ' ' . $lastName; ?></p>
                        <p><strong>Department:</strong> <?php echo $department; ?></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p><strong>Total Present Days:</strong> <?php echo $totalPresentDays; ?></p>
                        <p><strong>Total Absent Days:</strong> <?php echo $totalAbsentDays; ?></p>
                    </div>
                </div>

                <div class="salary-details">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Earnings</th>
                                <th>Amount (₹)</th>
                                <th>Deductions</th>
                                <th>Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Base Salary</td>
                                <td><?php echo number_format($totalSalary, 2); ?></td>
                                <td>PF</td>
                                <td><?php echo number_format($pf, 2); ?></td>
                            </tr>
                            <tr>
                                <td>HRA</td>
                                <td><?php echo number_format($hra, 2); ?></td>
                            </tr>
                            <tr>
                                <td>DA</td>
                                <td><?php echo number_format($da, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Total Earnings</th>
                                <th><?php echo number_format($totalEarnings, 2); ?></th>
                                <th>Total Deductions</th>
                                <th><?php echo number_format($totalDeductions, 2); ?></th>
                            </tr>
                            <tr>
                                <th colspan="2">Net Salary</th>
                                <th colspan="2"><?php echo number_format($netSalary, 2); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="authorized-signatory">
                    <img src="image/signature.png" alt="Admin Signature">
                    <p>Authorized Signatory</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <script>
        document.getElementById('download-btn').addEventListener('click', function() {
            html2canvas(document.getElementById('salary-slip')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);
                pdf.save('salary-slip.pdf');
            });
        });
    </script>
</body>
</html>
