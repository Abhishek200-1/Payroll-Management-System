<?php include('../../../Backend/Database/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Attendance Report</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
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

        $sql = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.Image, e.Department, e.Shift, a.date, a.Is_Present 
                FROM tbladdemployee e 
                LEFT JOIN tbladdattendance a ON e.Emp_Id = a.Emp_Id 
                WHERE YEAR(a.date) = '$year' AND MONTH(a.date) = '$month_number'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Department</th>
            <th>Date</th>
            <th>Status</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['Emp_Id']}</td>
                <td>{$row['First_Name']} {$row['Last_Name']}</td>
                <td>{$row['Department']}</td>
                <td>{$row['date']}</td>
                <td>{$row['Is_Present']}</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No attendance records found for the selected month.";
        }
    }
    ?>

</body>
</html>
