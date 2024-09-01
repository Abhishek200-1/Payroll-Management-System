<?php
include('../../../Backend/Database/connection.php');

// Constants for salary components (these can be adjusted)
define('HRA_PERCENTAGE', 0.10); // 10% HRA
define('DA_PERCENTAGE', 0.05); // 5% DA
define('PF_PERCENTAGE', 0.05); // 5% PF

// Function to calculate salary components and net salary
function calculateMonthlySalary($employee_id, $month_year) {
    global $conn;

    // Get employee base salary
    $employee_query = "SELECT salary FROM tbladdemployee WHERE Emp_Id = $employee_id";
    $employee_result = $conn->query($employee_query);
    $employee_data = $employee_result->fetch_assoc();
    $base_salary = $employee_data['salary'];

    // Get total days in the month
    $days_in_month = date('t', strtotime($month_year . '-01'));

    // Get attendance summary for the month
    $attendance_query = "
        SELECT 
            SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_days,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_days,
            SUM(CASE WHEN status = 'leave' THEN 1 ELSE 0 END) as leave_days
        FROM attendance
        WHERE employee_id = $employee_id 
        AND DATE_FORMAT(attendance_date, '%Y-%m') = '$month_year'";
    
    $attendance_result = $conn->query($attendance_query);
    $attendance_data = $attendance_result->fetch_assoc();

    $present_days = $attendance_data['present_days'];
    $absent_days = $attendance_data['absent_days'];
    $leave_days = $attendance_data['leave_days'];

    // Calculate daily salary
    $daily_salary = $base_salary / $days_in_month;

    // Calculate total salary before deductions
    $total_salary = ($daily_salary * $present_days);

    // Calculate HRA, DA, PF
    $hra = $base_salary * HRA_PERCENTAGE;
    $da = $base_salary * DA_PERCENTAGE;
    $pf = $base_salary * PF_PERCENTAGE;

    // Calculate net salary
    $net_salary = $total_salary + $hra + $da - $pf;

    // Save salary record
    $insert_salary_query = "
        INSERT INTO salaries (employee_id, month_year, base_salary, hra, da, pf, total_present_days, total_absent_days, total_leave_days, total_salary, net_salary)
        VALUES ($employee_id, '$month_year', $base_salary, $hra, $da, $pf, $present_days, $absent_days, $leave_days, $total_salary, $net_salary)
        ON DUPLICATE KEY UPDATE 
            hra = $hra,
            da = $da,
            pf = $pf,
            total_present_days = $present_days, 
            total_absent_days = $absent_days, 
            total_leave_days = $leave_days, 
            total_salary = $total_salary,
            net_salary = $net_salary";
    
    if ($conn->query($insert_salary_query) === TRUE) {
        echo "Salary calculated and saved successfully for Employee ID: $employee_id for the month $month_year.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

// Calculate salary for all employees for a specific month
if (isset($_POST['month_year'])) {
    $month_year = $_POST['month_year'];
    $employee_query = "SELECT Emp_Id FROM tbladdemployee WHERE status = 'active'";
    $employee_result = $conn->query($employee_query);

    while ($employee = $employee_result->fetch_assoc()) {
        calculateMonthlySalary($employee['Emp_Id'], $month_year);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculate Salary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Calculate Salary</h1>
    <form method="POST" action="calculate_salary.php">
        <label for="month_year">Select Month:</label>
        <input type="month" name="month_year" required>
        <button type="submit">Calculate Salary</button>
    </form>
</body>
</html>
