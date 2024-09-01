<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Table</title>
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../src/css/style-admin-display.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg justify-content-center fs-5 mb-5" style="background-color:#00ff5573;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Payroll Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../Dist/AdminDashbord.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Dist/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Dist/contact.php">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" action="" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" autocomplete="off" required name="SearchAttendance">
                    <button class="btn btn-outline-dark" name="SearchAttendanceBtn" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="my-5 mx-2">
        <div class="button-container">
            <button type="button" class="btn btn-info"><a href="../Attendance/add-attendance.php">Add Attendance</a></button>
        </div>
        <h3>Attendance Detailes</h3>
        <table class="table table-striped table-hover border-primary table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Emp Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">In Time</th>
                    <th scope="col">Out Time</th>
                    <th scope="col">Created On</th>
                    <th scope="col">Is Present</th>
                    <th scope="col">Work Time</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                include('../../../Backend/Database/connection.php');

                $query = "";
                if (isset($_POST["SearchAttendanceBtn"])) {
                    $searchText = $_POST["SearchAttendance"];

                    $query = "SELECT Emp_Id, First_Name, Last_Name, In_Time, Out_Time, Created_On, Is_Present, Work_Time FROM `tbladdattendance` WHERE Emp_Id LIKE '{$searchText}%' OR First_Name LIKE '{$searchText}%' OR Last_Name LIKE '{$searchText}%' OR In_Time LIKE '{$searchText}%' OR Out_Time LIKE '{$searchText}%' OR Created_On LIKE '{$searchText}%' OR Is_Present LIKE '{$searchText}%' OR Work_Time LIKE '{$searchText}%' ;";
                } else {
                    $query = "SELECT * FROM `tbladdattendance`";
                }
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $empId = $row['Emp_Id'];
                        $firstName = $row['First_Name'];
                        $lastname = $row['Last_Name'];
                        $inTime = $row['In_Time'];
                        $outTime = $row['Out_Time'];
                        $createdOn = $row['Created_On'];
                        $isPresent = $row['Is_Present'];
                        $workTime = $row['Work_Time'];
                        echo
                        '<tr>
                                <th scope="row">' . $empId . '</th>
                                    <td>' . $firstName . '</td>
                                    <td>' . $lastname . '</td>
                                    <td>' . $inTime . '</td>
                                    <td>' . $outTime . '</td>
                                    <td>' . $createdOn . '</td>
                                    <td width="188">
                                        <button class="btn btn-info"><a href="../Update/update-add-admin.php? updateid=' . $empId . '" class="text-light">Present</a></button>
                                        <button class="btn btn-warning"><a href="../Update/delete-add-admin.php? deleteid=' . $empId . '" class="text-light">Absent</a></button>
                                    </td>
                                    <td>' . $workTime . '</td>
                                <td width="185">
                                    <button class="btn btn-primary"><a href="../../Backend/Update/update-add-attendance.php? updateid=' . $empId . '" class="text-light">Update</a></button>
                                    <button class="btn btn-danger"><a href="../../Backend/Update/update-add-arrendance.php? deleteid=' . $empId . '" class="text-light">Delete</a></button>
                                </td>
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="padding: 15px; margin: 15px;">
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
    <?php
    include("../../../Backend/Database/connection.php");

    $year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
    $month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");

    // Calculate the number of days in the month
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Query to fetch employee attendance data for the specified month
    if (isset($_POST['SearchAttendanceBtn'])) {
        $searchInput = $_POST['SearchAttendance'];

        $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Created_On) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Created_On) = $year AND MONTH(a.Created_On) = $month
            WHERE e.First_Name LIKE '%$searchInput%' OR e.Last_Name LIKE '%$searchInput%'
            GROUP BY e.Emp_Id, Day
            ORDER BY e.Emp_Id, Day
        ";
    } else {
        // Original query without search, as used previously
        $query = "SELECT e.Emp_Id, e.First_Name, e.Last_Name,SEC_TO_TIME(SUM(TIME_TO_SEC(a.Work_Time))) AS Total_Work_Time,DAY(a.Created_On) AS Day, a.Is_Present
            FROM tbladdemployee e
            LEFT JOIN tbladdattendance a 
            ON e.Emp_Id = a.Emp_Id AND YEAR(a.Created_On) = $year AND MONTH(a.Created_On) = $month
            GROUP BY e.Emp_Id, Day
            ORDER BY e.Emp_Id, Day
        ";
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Prepare an array to hold the data
    $attendanceData = [];

    // Fetch the data and organize it by employee and day
    while ($row = mysqli_fetch_assoc($result)) {
        $empId = $row['Emp_Id'];
        $day = $row['Day'];

        // Initialize the employee's data array if it doesn't exist
        if (!isset($attendanceData[$empId])) {
            $attendanceData[$empId] = [
                'Emp_Id' => $empId,
                'First_Name' => $row['First_Name'],
                'Last_Name' => $row['Last_Name'],
                'Total_Work_Time' => $row['Total_Work_Time'],
                'Days' => array_fill(1, $daysInMonth, ''), // Initialize days with empty strings
                'Total_Present' => 0 // Initialize total present days count
            ];
        }

        // Mark the day as "P" if the employee was present and "A" if absent
        if ($row['Is_Present']) {
            if ($row['Is_Present'] == "present") {
                $attendanceData[$empId]['Days'][$day] = 'P';
                $attendanceData[$empId]['Total_Present']++;
            } else {
                $attendanceData[$empId]['Days'][$day] = 'A';
            }
        }
    }
    // Start the table
    echo ' <table class="table table-striped table-hover border-primary table-bordered">
            <thead class="table-light">';
    echo '<tr>
        <th>Emp_Id</th>
        <th>Employee Name</th>
        <th>Total Work Time</th>';

    // Dynamically create a header for each day of the month with actual dates
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = date('Y-m-d', strtotime("$year-$month-$day"));
        echo '<th>' . $date . '</th>';
    }
    echo '<th>Total Present Days</th>'; // Add header for total present days
    echo '</tr>
    </thead>';

    // Output each employee's data
    foreach ($attendanceData as $empData) {
        echo '<tr>
            <td>' . $empData['Emp_Id'] . '</td>
            <td>' . $empData['First_Name'] . " " . $empData['Last_Name'] . '</td>
            <td>' . $empData['Total_Work_Time'] . '</td>';
        // Output the attendance status for each day
        for ($day = 1; $day <= $daysInMonth; $day++) {
            echo '<td>' . $empData['Days'][$day] . '</td>';
        }
        echo '<td>' . $empData['Total_Present'] . '</td>'; // Output total present days
        echo '</tr>';
    }
    // End the table
    echo '</table>';

    // Close the connection
    mysqli_close($conn);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>