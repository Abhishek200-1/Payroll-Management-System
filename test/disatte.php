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
    <link rel="stylesheet" href="attendance.css">
    <title>PayRoll Management System</title>
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
        <div style="Padding: 15px; margin: 15px;">
            <form method="GET" action="">
                <label for="year">Select Year:</label>
                <select name="year" id="year">
                    <?php
                    $currentYear = date("Y");
                    for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                        echo '<option value="' . $y . '">' . $y . '</option>';
                    }
                    ?>
                </select>

                <label for="month">Select Month:</label>
                <select name="month" id="month">
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $monthName = date("F", mktime(0, 0, 0, $m, 10)); // Get full month name
                        echo '<option value="' . $m . '">' . $monthName . '</option>';
                    }
                    ?>
                </select>

                <input type="submit" value="Show Attendance">
            </form>
        </div>
        <div class="table-body">
            <h4>Attendance Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='take-attendance.php'"><i class="fa-solid fa-clipboard-user me-2"></i>Take Attendance</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='view_attendance.php'"><i class="fa-regular fa-calendar-days me-2"></i>Monthly Attendance Report</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='calculate_salary.php'"><i class="fa-solid fa-calculator me-2"></i>Calculate Salary</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='salary_report.php'"><i class="fa-solid fa-file-invoice me-2"></i>Salary Report</button>
            <!-- <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr>
                        <th class="col">Emp Id</th>
                        <th class="col">Employee Name</th>
                        <?php
                        // Generate day headers for the selected month
                        $month = 8; // August
                        $year = 2024;
                        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                        for ($day = 1; $day <= $days_in_month; $day++) {
                            echo "<th>$day</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    include('../../../Backend/Database/connection.php');
                    $i = 1;
                    $query = "";
                    if (isset($_POST["SearchEmployeeBtn"])) {
                        $searchText = $_POST["SearchEmployee"];

                        $query = "SELECT Emp_Id, First_Name, Last_Name, Department, Shift, Pnumber, Date_Of_Joining, salary FROM `tbladdemployee` WHERE Emp_Id LIKE '{$searchText}%' OR First_Name LIKE '{$searchText}%' OR Last_Name LIKE '{$searchText}%' OR Department LIKE '{$searchText}%' OR Shift LIKE '{$searchText}%' OR Pnumber LIKE '{$searchText}%'  OR Date_Of_Joining LIKE '{$searchText}%' OR salary LIKE '{$searchText}%';";
                    } else {
                        $query = "SELECT Emp_Id, First_Name, Last_Name, Department, Shift, Pnumber, Date_Of_Joining, salary FROM `tbladdemployee`";
                    }
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Emp_Id = $row['Emp_Id'];
                            $name = $row['First_Name'];
                            $lastname = $row['Last_Name'];
                            echo
                            '<tr>
                                <th scope="row">' . $i++ . '</th>
                                <td>' . $name . ' '  . $lastname .  '</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                                <td>P</td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table> -->
            <?php
            include("../../../Backend/Database/connection.php");

            $year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
            $month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            if (isset($_POST['SearchAttendanceBtn'])) {
                $searchInput = $_POST['SearchAttendance'];

                $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Date) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month
            WHERE e.First_Name LIKE '%$searchInput%' OR e.Last_Name LIKE '%$searchInput%'
            GROUP BY e.Emp_Id, Day
            ORDER BY e.Emp_Id, Day
        ";
            } else {
                $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Date) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month
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
                        'Total_Work_Time' => $row['Total_Work_Time'],
                        'Days' => array_fill(1, $daysInMonth, ''),
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
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">';
                    <tr>
                        <th class="col">Emp Id</th>
                        <th class="col">Emp Name</th>
                        <th class="col">T.W.T.</th>
                        <?php
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            echo '<th>' . $day . '</th>';
                        }
                        ?>
                        <th class="col">Total Present Days</th>
                    </tr>
                </thead>
                <?php
                foreach ($attendanceData as $empData) {
                    echo '<tr>
                            <td>' . $empData['Emp_Id'] . '</td>
                            <td>' . $empData['First_Name'] . " " . $empData['Last_Name'] . '</td>
                            <td>' . $empData['Total_Work_Time'] . '</td>';
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        echo '<td>' . $empData['Days'][$day] . '</td>';
                    }
                    echo '<td>' . $empData['Total_Present'] . '</td>'; // Output total present days
                    echo '</tr>';
                }
                echo '</table>';
                mysqli_close($conn);
                ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>