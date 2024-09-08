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

        $sql = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.employeeprofile, e.Department, e.Shift, a.date, a.Is_Present 
                FROM tbladdemployee e 
                LEFT JOIN tbladdattendance a ON e.Emp_Id = a.Emp_Id 
                WHERE YEAR(a.date) = '$year' AND MONTH(a.date) = '$month_number'";

        $result = $conn->query($sql);

        // if ($result->num_rows > 0) {
        //     echo "<table border='1'>";
        //     echo "<tr>
        //     <th>Employee ID</th>
        //     <th>Employee Name</th>
        //     <th>Department</th>
        //     <th>Date</th>
        //     <th>Status</th>
        //     </tr>";
        //     while ($row = $result->fetch_assoc()) {
        //         echo "<tr>
        //         <td>{$row['Emp_Id']}</td>
        //         <td>{$row['First_Name']} {$row['Last_Name']}</td>
        //         <td>{$row['Department']}</td>
        //         <td>{$row['date']}</td>
        //         <td>{$row['Is_Present']}</td>
        //         </tr>";
        //     }
        //     echo "</table>";
        // } else {
        //     echo "No attendance records found for the selected month.";
        // }

        include("../../../Backend/Database/connection.php");

        $year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");
        $month_number = date('m', strtotime($month));

        // $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        if (isset($_POST['SearchAttendanceBtn'])) {
            $searchInput = $_POST['SearchAttendance'];

            $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.employeeprofile, e.Department, e.Shift, a.date, SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Date) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month_number
            WHERE e.First_Name LIKE '%$searchInput%' OR e.Last_Name LIKE '%$searchInput%'
            GROUP BY e.Emp_Id, Day
            ORDER BY e.Emp_Id, Day
        ";
        } else {
            $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.Department, e.Shift, a.date, SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Date) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month_number
            GROUP BY e.Emp_Id, Day
            ORDER BY e.Emp_Id, Day
        ";
        }
        $result = mysqli_query($conn, $query);
        $attendanceData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $empId = $row['Emp_Id'];
            $day = $row['Day'];
            if (!isset($attendanceData[$empId])) {
                $attendanceData[$empId] = [
                    'Emp_Id' => $empId,
                    'First_Name' => $row['First_Name'],
                    'Last_Name' => $row['Last_Name'],
                    'Department' => $row['Department'],
                    'Total_Present' => 0
                ];
            }
            if ($row['Is_Present']) {
                if ($row['Is_Present'] == "present") {
                    $attendanceData[$empId]['Days'][$day] = 'P';
                    $attendanceData[$empId]['Total_Present']++;
                } else {
                    $attendanceData[$empId]['Days'][$day] = 'A';
                }
            }
        }
    ?>
        <table border='1' cellspacing="0">
            <thead class="table-info">
                <tr>
                    <th class="col">Emp Id</th>
                    <th class="col">Employee Name</th>
                    <th>Department</th>
                    <th class="col">T.P.D.</th>
                </tr>
            </thead>
        <?php
        foreach ($attendanceData as $empData) {
            echo
            '<tr>
            <td align="center">' . $empData['Emp_Id'] . '</td>
            <td>' . $empData['First_Name'] . " " . $empData['Last_Name'] . '</td>';
            echo '<td align="center">' . $empData['Department'] . '</td>';
            echo '<td align="center">' . $empData['Total_Present'] . '</td>';
            echo '</tr>';
            $insertPresentDaysQuery = "UPDATE salaries SET total_present_days=" . $empData['Total_Present'] . " WHERE employee_id="  . $empData['Emp_Id'] . ";";
            $insertResult = mysqli_query($conn, $insertPresentDaysQuery);
            if ($insertResult) {
               
            } else {
                echo "Record not updated for : " . $empData['Emp_Id'] . "<br> " . mysqli_error($conn);
            }
        }
        echo '</table>';
        mysqli_close($conn);
    }
        ?>

</body>

</html>