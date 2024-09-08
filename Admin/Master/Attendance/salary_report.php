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
            <form method="GET">
                <label for="month">Select Month:</label>
                <input type="month" name="month" required>
                <input type="submit" value="View Report">
                <!-- <button type="submit">View Report</button> -->
            </form>
            <div class="Indications">
                    <h5>---Indications---</h5>
                    <p>** T.W.T. -> Total Working Time</p> 
                    <p>** T.P.D. -> Total Present Days</p>
            </div>
        </div>
        <div class="table-body">
            <h4>Employee's Monthly Salary Report...</h4>
            <table class="col-xs-7 table table-striped table-condensed table-fixed table-bordered " cellspacing="0">
                <thead class="table-info">
                    <tr align="center">
                        <th class="col">Emp Id</th>
                        <th class="col">Employee Name</th>
                        <th class="col">Base Salary</th>
                        <th class="col">HRA</th>
                        <th class="col">DA</th>
                        <th class="col">PF</th>
                        <th class="col">Present Days</th>
                        <th class="col">Absent Days</th>
                        <th class="col">Leave Days</th>
                        <th class="col">Total Salary</th>
                        <th class="col">Net Salary</th>
                    </tr>
                </thead>
                <?php
                    if (isset($_GET['month'])) {
                        $month = $_GET['month'];
                        $sql = "SELECT s.employee_id, e.First_Name,e.Last_Name, s.base_salary, s.hra, s.da, s.pf, s.total_present_days, s.total_absent_days, s.total_leave_days, s.total_salary, s.net_salary 
                                FROM salaries s 
                                JOIN tbladdemployee e ON s.employee_id = e.Emp_Id 
                                WHERE s.month_year = '$month'";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr align='center'>
                                        <td>{$row['employee_id']}</td>
                                        <td>{$row['First_Name']} {$row['Last_Name']}</td>
                                        <td>{$row['base_salary']}</td>
                                        <td>{$row['hra']}</td>
                                        <td>{$row['da']}</td>
                                        <td>{$row['pf']}</td>
                                        <td>{$row['total_present_days']}</td>
                                        <td>{$row['total_absent_days']}</td>
                                        <td>{$row['total_leave_days']}</td>
                                        <td>{$row['total_salary']}</td>
                                        <td>{$row['net_salary']}</td>
                                    </tr>";
                            }
                            echo "</table>";
                        } 
                        else 
                        {
                            echo "No salary records found for the selected month.";
                        }
                    }
                ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>