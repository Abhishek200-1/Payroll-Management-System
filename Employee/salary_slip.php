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

// Fetch salary data
$query = "SELECT * FROM salaries WHERE employee_id = '$empId'";
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
    $salaryDate = $salaryRow['month_year'];
    $totalEarnings = $totalSalary + $hra + $da;
    $totalDeductions = $pf;
    $netSalary = $totalEarnings - $totalDeductions;
} else {
    die("No salary data found for this employee.");
}


$currentMonth = date('F'); // Full month name (e.g., September)
$currentYear = date('Y'); // Full year (e.g., 2024)
$salaryDate = "$currentMonth $currentYear";
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
    <div id="salary-slip" class="salary-slip">
        <div class="logo">
            <img src="image/hello.png" style="width: 60px;" alt="Company Logo">
        </div>
        <h3>Salary Slip for <?php echo $salaryDate; ?></h3>

        <div class="employee-details row">
            <div class="col-md-6">
                <p><strong>Employee ID:</strong> <span id="employeeId"><?php echo $empId; ?></span></p>
                <p><strong>Name:</strong> <span id="employeeName"><?php echo $firstName . ' ' . $lastName; ?></span></p>
                <p><strong>Department:</strong> <span id="employeeDepartment"><?php echo $department; ?></span></p>
            </div>
            <div class="col-md-6 text-end">
                <p><strong>Salary Date:</strong> <span id="salaryDate"><?php echo $salaryDate; ?></span></p>
                <p><strong>Total Present Days:</strong> <span id="totalPresentDays"><?php echo $totalPresentDays; ?></span></p>
                <p><strong>Total Absent Days:</strong> <span id="totalAbsentDays"><?php echo $totalAbsentDays; ?></span></p> 
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
                        <td id="basicSalary"><?php echo number_format($totalSalary, 2); ?></td>
                        <td>PF</td>
                        <td id="pf"><?php echo number_format($pf, 2); ?></td>
                    </tr>
                    <tr>
                        <td>HRA</td>
                        <td id="hra"><?php echo number_format($hra, 2); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>DA</td>
                        <td id="da"><?php echo number_format($da, 2); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Total Earnings</th>
                        <th id="totalEarnings"><?php echo number_format($totalEarnings, 2); ?></th>
                        <th>Total Deductions</th>
                        <th id="totalDeductions"><?php echo number_format($totalDeductions, 2); ?></th>
                    </tr>
                    <tr>
                        <th colspan="2" class="net-salary">Net Salary</th>
                        <th colspan="2" class="net-salary" id="netSalary"><?php echo number_format($netSalary, 2); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="authorized-signatory">
            <img src="image/signature.png" alt="Admin Signature">
            <p>Authorized Signatory</p>
        </div>
    </div>

    <button id="download-btn" class="btn btn-primary">Download PDF</button>
    <button onclick="window.location.href='EmployeeDashboard.php'" class="btn btn-secondary">Back to Dashboard</button>

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
