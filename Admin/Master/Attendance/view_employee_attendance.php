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
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
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
        <div class="table-uppar-second">
            <form method="GET" action="">
                <label for="month"><i class="fa-solid fa-calendar-days me-2"></i>Select Month :</label>
                <select name="month" id="month">
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $monthName = date("F", mktime(0, 0, 0, $m, 10)); // Get full month name
                        echo '<option value="' . $m . '">' . $monthName . '</option>';
                    }
                    ?>
                </select>

                <label for="year"><i class="fa-solid fa-calendar-days me-2"></i>Select Year :</label>
                <select name="year" id="year">
                    <?php
                    $currentYear = date("Y");
                    for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                        echo '<option value="' . $y . '">' . $y . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Show Attendance">
            </form>
            <div class="Indications">
                <h5>---Indications---</h5>
                <p>** T.W.T. -> Total Working Time</p>
                <p>** T.P.D. -> Total Present Days</p>
            </div>
        </div>
        <div class="table-body">
            <h4>Employee's Attendance Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='take-attendance.php'"><i class="fa-solid fa-clipboard-user me-2"></i>Take Attendance</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='view_attendance.php'"><i class="fa-regular fa-calendar-days me-2"></i>Monthly Attendance Report</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='calculate_salary.php'"><i class="fa-solid fa-calculator me-2"></i>Calculate Salary</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='salary_report.php'"><i class="fa-solid fa-file-invoice me-2"></i>Salary Report</button>

            <?php
            $year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
            $month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            if (isset($_POST['SearchAttendanceBtn'])) {
                $searchInput = $_POST['SearchAttendance'];

                $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time, DAY(a.Date) AS Day, a.Is_Present
                          FROM tbladdemployee e
                          LEFT JOIN tbladdattendance a 
                          ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month
                          WHERE e.First_Name LIKE '%$searchInput%' OR e.Last_Name LIKE '%$searchInput%'
                          GROUP BY e.Emp_Id, Day
                          ORDER BY e.Emp_Id, Day";
            } else {
                $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time, DAY(a.Date) AS Day, a.Is_Present
                          FROM tbladdemployee e
                          LEFT JOIN tbladdattendance a 
                          ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month
                          GROUP BY e.Emp_Id, Day
                          ORDER BY e.Emp_Id, Day";
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
            <table class="col-xs-7 table table-striped table-condensed table-fixed table-bordered" cellspacing="0">
                <thead class="table-info">
                    <tr>
                        <th class="col">Emp Id</th>
                        <th class="col">Employee Name</th>
                        <th class="col">T.W.T.</th>
                        <?php
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            echo '<th>' . $day . '</th>';
                        }
                        ?>
                        <th class="col">T.P.D.</th>
                    </tr>
                </thead>
                <?php
                foreach ($attendanceData as $empData) {
                    echo '<tr>
                            <td align="center">' . $empData['Emp_Id'] . '</td>
                            <td>' . $empData['First_Name'] . " " . $empData['Last_Name'] . '</td>
                            <td align="center">' . $empData['Total_Work_Time'] . '</td>';
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $status = $empData['Days'][$day];
                        $backgroundColor = '';
                        if ($status == 'P') {
                            $backgroundColor = 'style="color: #28a745;"';
                        } elseif ($status == 'A') {
                            $backgroundColor = 'style="color: #dc3545;"';
                        }
                        echo '<td ' . $backgroundColor . '>' . $status . '</td>';
                    }
                    echo '<td align="center">' . $empData['Total_Present'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

                // Salary Calculation
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CalculateSalaryBtn'])) {
                    $salaryQuery = "SELECT e.Emp_Id, e.First_Name, e.Last_Name, e.Base_Salary, e.HRA, e.DA, e.PF,
                                    COUNT(a.Is_Present) AS Total_Present_Days
                                    FROM tbladdemployee e
                                    LEFT JOIN tbladdattendance a 
                                    ON e.Emp_Id = a.Emp_Id AND YEAR(a.Date) = $year AND MONTH(a.Date) = $month AND a.Is_Present = 'present'
                                    GROUP BY e.Emp_Id";

                    $salaryResult = mysqli_query($conn, $salaryQuery);

                    while ($salaryRow = mysqli_fetch_assoc($salaryResult)) {
                        $empId = $salaryRow['Emp_Id'];
                        $baseSalary = $salaryRow['Base_Salary'];
                        $hra = $salaryRow['HRA'];
                        $da = $salaryRow['DA'];
                        $pf = $salaryRow['PF'];
                        $totalPresentDays = $salaryRow['Total_Present_Days'];

                        $perDaySalary = $baseSalary / $daysInMonth;
                        $grossSalary = $perDaySalary * $totalPresentDays;
                        $totalHRA = ($hra / 100) * $grossSalary;
                        $totalDA = ($da / 100) * $grossSalary;
                        $totalPF = ($pf / 100) * $grossSalary;

                        $netSalary = $grossSalary + $totalHRA + $totalDA - $totalPF;

                        $insertSalaryQuery = "INSERT INTO salaries (Emp_Id, Year, Month, Base_Salary, Gross_Salary, HRA, DA, PF, Net_Salary, Total_Present_Days)
                                              VALUES ('$empId', '$year', '$month', '$baseSalary', '$grossSalary', '$totalHRA', '$totalDA', '$totalPF', '$netSalary', '$totalPresentDays')
                                              ON DUPLICATE KEY UPDATE
                                              Gross_Salary='$grossSalary', HRA='$totalHRA', DA='$totalDA', PF='$totalPF', Net_Salary='$netSalary', Total_Present_Days='$totalPresentDays'";

                        mysqli_query($conn, $insertSalaryQuery);
                    }

                    echo "<div class='alert alert-success'>Salaries calculated and updated successfully!</div>";
                }
            ?>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>
