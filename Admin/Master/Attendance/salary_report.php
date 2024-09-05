<?php include('../../../Backend/Database/connection.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Salary Report</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
</head>

<body>
    <h1>Salary Report</h1>

    <form method="GET" action="salary_report.php">
        <label for="month">Select Month:</label>
        <input type="month" name="month" required>
        <button type="submit">View Report</button>
    </form>

    <?php
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $sql = "SELECT s.employee_id, e.First_Name, s.base_salary, s.hra, s.da, s.pf, s.total_present_days, s.total_absent_days, s.total_leave_days, s.total_salary, s.net_salary 
                FROM salaries s 
                JOIN tbladdemployee e ON s.employee_id = e.Emp_Id 
                WHERE s.month_year = '$month'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Base Salary</th>
                <th>HRA</th>
                <th>DA</th>
                <th>PF</th>
                <th>Present Days</th>
                <th>Absent Days</th>
                <th>Leave Days</th>
                <th>Total Salary</th>
                <th>Net Salary</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['employee_id']}</td>
                        <td>{$row['First_Name']}</td>
                        <td>{$row['base_salary']}</td>
                        <td>{$row['hra']}</td>
                        <td>{$row['da']}</td>
                        <td>{$row['pf']}</td>
                        <td>{$row['total_present_days']}</td>
                        <td>{$row['total_absent_days']}</td>
                        <td>{$row['total_leave_days']}</td>
                        <td>{$row['total_salary']}</td>
                        <td>{$row['net_salary']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No salary records found for the selected month.";
        }
    }
    ?>

</body>

</html>