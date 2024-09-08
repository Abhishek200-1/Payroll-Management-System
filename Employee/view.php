<?php
session_start();
include("../Backend/Database/connection.php");
$empId = $_SESSION["EmployeeId"];
$year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
$month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
    <link rel="stylesheet" href="hey.css">
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
                        echo '<option value="' . $m . '" ' . ($m == $month ? 'selected' : '') . '>' . $monthName . '</option>';
                    }
                    ?>
                </select>

                <label for="year"><i class="fa-solid fa-calendar-days me-2"></i>Select Year :</label>
                <select name="year" id="year">
                    <?php
                    $currentYear = date("Y");
                    for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                        echo '<option value="' . $y . '" ' . ($y == $year ? 'selected' : '') . '>' . $y . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-light">Show Attendance</button>
            </form>
            <div class="Indications">
                <h5>---Indications---</h5>
                <p>** T.W.T. -> Total Working Time</p> 
                <p>** T.P.D. -> Total Present Days</p>
            </div>
        </div>
        <div class="table-body">
            <h4>Your Attendance for <?php echo date("F Y", mktime(0, 0, 0, $month, 1, $year)); ?></h4>
            <?php
            // Query to fetch employee's attendance for the selected month and year
            $query = "SELECT Emp_Id, DAY(Date) AS Day, Work_Time, Is_Present
                      FROM tbladdattendance 
                      WHERE Emp_Id = $empId 
                      AND YEAR(Date) = $year 
                      AND MONTH(Date) = $month 
                      ORDER BY Day";

            $result = mysqli_query($conn, $query);
            

            // Prepare data for the table
            $attendanceData = array_fill(1, $daysInMonth, ['status' => '', 'work_time' => '']);
            $totalPresentDays = 0; // Initialize total present days

            while ($row = mysqli_fetch_assoc($result)) {
                $day = $row['Day'];
                $attendanceData[$day] = [
                    'status' => $row['Is_Present'],
                    'work_time' => $row['Work_Time']
                ];
                if ($row['Is_Present'] == 'present') {
                    $totalPresentDays++; // Increment total present days
                }
            }
            ?>
            <table class="col-xs-7 table table-striped table-condensed table-fixed table-bordered " cellspacing="0">
                <thead class="table-info">
                    <tr align="center">
                        <th class="col">Day</th>
                        <?php
                            for ($day = 1; $day <= $daysInMonth; $day++) { echo "<th>$day</th>"; }
                        ?>
                        <th class="col">T.P.D.</th> <!-- Total Present Days Column -->
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        <td>Status</td>
                        <?php
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $status = $attendanceData[$day]['status'];
                            $backgroundColor = '';
                            if ($status == 'present') {
                                $backgroundColor = 'style="color: #28a745;"';
                                $status = 'P';
                            } elseif ($status == 'absent') {
                                $backgroundColor = 'style="color: #dc3545;"';
                                $status = 'A';
                            }
                            echo '<td ' . $backgroundColor . '>' . $status . '</td>';
                        }
                        ?>
                        <td><?php echo $totalPresentDays; ?></td> <!-- Display total present days -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>
