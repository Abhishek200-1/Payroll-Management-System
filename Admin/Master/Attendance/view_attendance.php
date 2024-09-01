<?php include('../../../Backend/Database/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Attendance Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Monthly Attendance Report</h1>

    <form method="GET" action="view_attendance.php">
        <label for="month">Select Month:</label>
        <input type="month" name="month" required>
        <button type="submit">View Report</button>
    </form>

    <?php
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $year = date('Y', strtotime($month));
        $month_number = date('m', strtotime($month));

        $sql = "SELECT e.Emp_Id, e.First_Name, e.Department, a.attendance_date, a.status 
                FROM tbladdemployee e 
                LEFT JOIN attendance a ON e.Emp_Id = a.employee_id 
                WHERE YEAR(a.attendance_date) = '$year' AND MONTH(a.attendance_date) = '$month_number'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Employee ID</th><th>Name</th><th>Department</th><th>Date</th><th>Status</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['Emp_Id']}</td><td>{$row['First_Name']}</td><td>{$row['Department']}</td><td>{$row['attendance_date']}</td><td>{$row['status']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No attendance records found for the selected month.";
        }
    }
    ?>

</body>
</html>
