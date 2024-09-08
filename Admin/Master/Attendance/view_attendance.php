<?php
include("../../../Backend/Database/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
        <link rel="stylesheet" href="attendance.css">
    <title>Monthly Attendance Report</title>
</head>

<body>
    <div class="container-fluid">
        <div class="table-uppar">
            <div class="Button-container">
                <Button type="button" class="btn btn-light" onclick="location.href='../../../Dist/MainDashbord.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</Button>
            </div>
            <form action="" method="post">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchAttendance">
                    <button class="btn btn-outline-light" name="SearchAttendanceBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="table-uppar-second">
            <form method="GET">
                <label for="month">Select Month:</label>
                <input type="month" name="month" required>
                <input type="submit" value="View Report">
            </form>
            <div class="Indications">
                    <h5>---Indications---</h5>
                    <p>** T.W.T. -> Total Working Time</p> 
                    <p>** T.P.D. -> Total Present Days</p>
            </div>
        </div>
        <div class="table-body">
            <h4>Monthly Attendance Report</h4>
            <?php
                if (isset($_GET['month'])){
                    $month = $_GET['month'];
                    $year = date('Y', strtotime($month));
                    $month_number = date('m', strtotime($month));

                    $sql = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.employeeprofile, e.Department, e.Shift, a.date, a.Is_Present 
                            FROM tbladdemployee e 
                            LEFT JOIN tbladdattendance a ON e.Emp_Id = a.Emp_Id 
                            WHERE YEAR(a.date) = '$year' AND MONTH(a.date) = '$month_number'";

                    $result = $conn->query($sql);

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
                                'Shift' => $row['Shift'],
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
            <table class="col-xs-7 table table-striped table-condensed table-fixed table-bordered " cellspacing="0">
                <thead class="table-info">
                    <tr align="center"> 
                        <th class="col">Emp Id</th>
                        <th class="col">Employee Name</th>
                        <th class="col">Last Name</th>
                        <th class="col">Shift</th>
                        <th class="col">Department</th>
                        <th class="col">T.P.D.</th>
                    </tr>
                </thead>
                <?php
                    foreach ($attendanceData as $empData) 
                    {
                        echo
                        '<tr>
                        <td align="center">' . $empData['Emp_Id'] . '</td>
                        <td align="center">' . $empData['First_Name'] . '</td>';
                        echo '<td align="center">'. $empData['Last_Name'] .'</td>';
                        echo '<td align="center">' . $empData['Shift'] . '</td>';
                        echo '<td align="center">' . $empData['Department'] . '</td>';
                        echo '<td align="center">' . $empData['Total_Present'] . '</td>';
                        echo '</tr>';
                        $insertPresentDaysQuery = "UPDATE salaries SET total_present_days=" . $empData['Total_Present'] . " WHERE employee_id="  . $empData['Emp_Id'] . ";";
                        $insertResult = mysqli_query($conn, $insertPresentDaysQuery);
                        if ($insertResult) {
                           
                        } else {
                            echo "Record not updated for : " . $empData['Emp_Id'] . "<br> " . mysqli_error($conn);
                        }
                    }   echo '</table>'; mysqli_close($conn);
                }
                ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>
</html>