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
                <Button type="button" class="btn btn-light" onclick="location.href='../Dist/MainDashbord.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</Button>
            </div>
            <form action="" method="post">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchAdmin">
                    <button class="btn btn-outline-light" name="SearchAdminBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="table-body">
            <h4>Attendance Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='mark-attendance.php'"><i class="fa-solid fa-clipboard-user me-2"></i>Take Attendance</button>
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
</body>
</html>