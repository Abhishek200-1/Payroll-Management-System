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
                <button type="button" class="btn btn-light" onclick="location.href='#'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</button>
            </div>
            <form action="" method="post">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchAdmin">
                    <button class="btn btn-outline-light" name="SearchAdminBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <form method="POST" action="save_attendance.php">
            <div class="table-body">
                <!-- <h4>Attendance Master Table</h4> -->
                <!-- <button class="add btn btn-light" 'type="submit"' onclick="location.href='mark-attendance.php'"><i class="fa-solid fa-clipboard-user me-2"></i>Take Attendance</button>
                <button class="add btn btn-light" 'type="submit"' onclick="location.href='view_attendance.php'"><i class="fa-regular fa-calendar-days me-2"></i>Monthly Attendance Report</button>
                <button class="add btn btn-light" 'type="submit"' onclick="location.href='calculate_salary.php'"><i class="fa-solid fa-calculator me-2"></i>Calculate Salary</button>
                <button class="add btn btn-light" 'type="submit"' onclick="location.href='salary_report.php'"><i class="fa-solid fa-file-invoice me-2"></i>Salary Report</button> -->
            
                    <form method="GET" action="view_attendance.php" class="row g-3">
                        <div class="col-md-2">
                            <label for="month" class="form-label" style="margin-top: 5px; margin-left:22px; font-weight:600">Select Month</label>
                            <input type="month" name="month" id="month" class="form-control" style="margin-left:15px; margin-bottom:10px" required>
                        </div>
                        <button type="submit" class="btn btn-primary ms-4" style="width: 150px; height:40px; margin-top:35px;">View Report</button>
                    </form>
                
                <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                        <tr>
                            <th class="col">Emp Id</th>
                            <th class="col">Fisrt Name</th>
                            <th class="col">Department</th>
                            <th class="col">Date</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php
                        if (isset($_GET['month'])) {
                            $month = $_GET['month'];
                            $year = date('Y', strtotime($month));
                            $month_number = date('m', strtotime($month));

                            $sql = "SELECT e.Emp_Id, e.First_Name, e.Department, a.attendance_date, a.status 
                                    FROM tbladdemployee e 
                                    LEFT JOIN tblattandance a ON e.Emp_Id = a.employee_id 
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

                        <?php
                            $result = $conn->query("SELECT * FROM tbladdemployee WHERE status='active'");
                            while ($row = $result->fetch_assoc()) 
                            {
                                echo 
                                "<tr>
                                    <td>{$row['Emp_Id']}</td>
                                    <td>{$row['First_Name']}</td>
                                    <td>{$row['Last_Name']}</td>
                                    <td>{$row['Department']}</td>
                                    <td><input type='checkbox' name='attendance[{$row['Emp_Id']}]' value='present'></td>
                                    <td>
                                        <select name='leave[{$row['Emp_Id']}]'>
                                            <option value=''>No Leave</option>
                                            <option value='leave'>Leave</option>
                                        </select>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <!-- <button class="addattendance btn btn-light" type="submit"><i class="fa-solid fa-floppy-disk me-2"></i>Save Attendance</button> -->
            </div>
        </form>
    </div>
</body>
</html>