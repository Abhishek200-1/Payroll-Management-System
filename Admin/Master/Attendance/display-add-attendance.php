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
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchEmployee">
                    <button class="btn btn-outline-light" name="SearchEmployeeBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="table-body">
            <h4>Attendance Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='take-attendance.php'"><i class="fa-solid fa-clipboard-user me-2"></i>Take Attendance</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='view_attendance.php'"><i class="fa-regular fa-calendar-days me-2"></i>Monthly Attendance Report</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='calculate_salary.php'"><i class="fa-solid fa-calculator me-2"></i>Calculate Salary</button>
            <button class="add btn btn-light" type="submit" onclick="location.href='salary_report.php'"><i class="fa-solid fa-file-invoice me-2"></i>Salary Report</button>
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr>
                        <th class="col">Emp Id</th>
                        <th class="col">Fisrt Name</th>
                        <th class="col">Last Name</th>
                        <th class="col">Department</th>
                        <th class="col">Shift</th>
                        <th class="col">Phone Number</th>
                        <th class="col">Date Of Joining</th>
                        <th class="col">Base Salary</th>
                        <th class="col">Operations</th>
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
                            $Department = $row['Department'];
                            $Shift = $row['Shift'];
                            $Pnumber = $row['Pnumber'];
                            $Doj = $row['Date_Of_Joining'];
                            $Salary = $row['salary'];
                            echo '<tr>
                                <th scope="row">' . $i++ . '</th>
                                    <td>' . $name . '</td>
                                    <td>' . $lastname . '</td>
                                    <td>' . $Department . '</td>
                                    <td>' . $Shift  . '</td>
                                    <td>' . $Pnumber . '</td>
                                    <td>' . $Doj . '</td>
                                    <td>' . $Salary . '</td>
                                <td>
                                    <button><a href="update-add-employee.php? updateid=' . $Emp_Id . '" class="text-success"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></a></button>
                                    <button><a href="../../../Employee/EmployeeProfile.php? display=' . $Emp_Id . '" class="text-info mx-1"><i class="fa-solid fa-info fa-1x"></i></i></a></button>
                                    <button><a href="delete-add-employee.php? deleteid=' . $Emp_Id . '" class="text-danger"><i class="fa-solid fa-trash fa-1x"></i></i></a></button>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div style="padding: 15px; margin: 15px;">
        <form method="GET" action="">
            <label for="year">Select Year:</label>
            <select name="year" id="year">
                <?php
                // $currentYear = date("Y");
                // for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                //     echo '<option value="' . $y . '">' . $y . '</option>';
                // }
                ?>
            </select>

            <label for="month">Select Month:</label>
            <select name="month" id="month">
                <?php
                // for ($m = 1; $m <= 12; $m++) {
                //     $monthName = date("F", mktime(0, 0, 0, $m, 10)); // Get full month name
                //     echo '<option value="' . $m . '">' . $monthName . '</option>';
                // }
                ?>
            </select>

            <input type="submit" value="Show Attendance">
        </form>
        <form action="" method="post">
            <div class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchAttendance">
                <button class="btn btn-outline-light" name="SearchAttendanceBtn" type="submit">Search</button>
            </div>
        </form>
    </div> -->
    <?php
    // include("../../../Backend/Database/connection.php");

    // $year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
    // $month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");

    // // Calculate the number of days in the month
    // $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // // Query to fetch employee attendance data for the specified month
    // if (isset($_POST['SearchAttendanceBtn'])) {
    //     $searchInput = $_POST['SearchAttendance'];

    //     $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Created_On) AS Day, a.Is_Present
    //         FROM tbladdemployee e
    //         LEFT JOIN tbladdattendance a 
    //         ON e.Emp_Id = a.Emp_Id AND YEAR(a.Created_On) = $year AND MONTH(a.Created_On) = $month
    //         WHERE e.First_Name LIKE '%$searchInput%' OR e.Last_Name LIKE '%$searchInput%'
    //         GROUP BY e.Emp_Id, Day
    //         ORDER BY e.Emp_Id, Day
    //     ";
    // } else {
    //     // Original query without search, as used previously
    //     $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Created_On) AS Day, a.Is_Present
    //         FROM tbladdemployee e
    //         LEFT JOIN tbladdattendance a 
    //         ON e.Emp_Id = a.Emp_Id AND YEAR(a.Created_On) = $year AND MONTH(a.Created_On) = $month
    //         GROUP BY e.Emp_Id, Day
    //         ORDER BY e.Emp_Id, Day
    //     ";
    // }

    // // Execute the query
    // $result = mysqli_query($conn, $query);

    // // Prepare an array to hold the data
    // $attendanceData = [];

    // // Fetch the data and organize it by employee and day
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $empId = $row['Emp_Id'];
    //     $day = $row['Day'];

    //     // Initialize the employee's data array if it doesn't exist
    //     if (!isset($attendanceData[$empId])) {
    //         $attendanceData[$empId] = [
    //             'Emp_Id' => $empId,
    //             'First_Name' => $row['First_Name'],
    //             'Last_Name' => $row['Last_Name'],
    //             'Total_Work_Time' => $row['Total_Work_Time'],
    //             'Days' => array_fill(1, $daysInMonth, ''), // Initialize days with empty strings
    //             'Total_Present' => 0 // Initialize total present days count
    //         ];
    //     }

    //     // Mark the day as "P" if the employee was present and "A" if absent
    //     if ($row['Is_Present']) {
    //         if ($row['Is_Present'] == "present") {
    //             $attendanceData[$empId]['Days'][$day] = 'P';
    //             $attendanceData[$empId]['Total_Present']++;
    //         } else {
    //             $attendanceData[$empId]['Days'][$day] = 'A';
    //         }
    //     }
    // }
    // // Start the table
    // echo ' <table class="table table-striped table-hover border-primary table-bordered">
    //         <thead class="table-light">';
    // echo '<tr>
    //     <th>Emp_Id</th>
    //     <th>Employee Name</th>
    //     <th>Total Work Time</th>';

    // // Dynamically create a header for each day of the month with actual dates
    // for ($day = 1; $day <= $daysInMonth; $day++) {
    //     $date = date('Y-m-d', strtotime("$year-$month-$day"));
    //     echo '<th>' . $date . '</th>';
    // }
    // echo '<th>Total Present Days</th>'; // Add header for total present days
    // echo '</tr>
    // </thead>';

    // // Output each employee's data
    // foreach ($attendanceData as $empData) {
    //     echo '<tr>
    //         <td>' . $empData['Emp_Id'] . '</td>
    //         <td>' . $empData['First_Name'] . " " . $empData['Last_Name'] . '</td>
    //         <td>' . $empData['Total_Work_Time'] . '</td>';
    //     // Output the attendance status for each day
    //     for ($day = 1; $day <= $daysInMonth; $day++) {
    //         echo '<td>' . $empData['Days'][$day] . '</td>';
    //     }
    //     echo '<td>' . $empData['Total_Present'] . '</td>'; // Output total present days
    //     echo '</tr>';
    // }
    // // End the table
    // echo '</table>';

    // // Close the connection
    // mysqli_close($conn);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>