<?php
include("../../../Backend/Database/connection.php");
?>
<?php
    $FisrtDayOfMonth = date("1-m-Y");
    $totalDaysInMonth = date("t", strtotime($FisrtDayOfMonth));
    
    $totalNumbersOfStudents = 5;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="test.css">
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
            <h4>Employee's Attendance Of Month : <h4 class="calender"><?php echo strtoupper(date("F",strtotime($FisrtDayOfMonth))); ?></h4></h4>
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
                    <?php
                        for($i=1; $i<=$totalNumbersOfStudents + 2; $i++)
                        {
                            if($i == 1)
                            { 
                                for($j=1; $j<=$totalDaysInMonth; $j++)
                                {
                                    echo "<th>$j</th>";
                                }       
                            }
                        }
                    ?>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        { 
                            echo "<tr>";
                            echo "<td>01</td>";
                            echo "<td>Abhishek</td>";
                            echo "<td>Sharma</td>";
                                for($j=0; $j<$totalDaysInMonth; $j++)
                                {
                                    echo "<td>P</td>";
                                }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>