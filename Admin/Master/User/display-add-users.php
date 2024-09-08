<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/display-table-only.css">
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
    <title>Display-users</title>
</head>

<body>
    <div class="container-fluid">
        <div class="table-uppar">
            <div class="Button-container">
                <Button type="button" class="btn btn-light" onclick="location.href='../../../Dist/MainDashbord.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</Button>
            </div>
            <form action="" method="post">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" autocomplete="off" required name="SearchUser">
                    <button class="btn btn-outline-light" name="SearchUserBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="table-body">
            <h4>Employee Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='../Employee/add-employee.php'"><i class="fa-solid fa-plus me-2"></i>Add New User</button>
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr>
                        <th class="col">Emp Id</th>
                        <th class="col">Fisrt Name</th>
                        <th class="col">Last Name</th>
                        <th class="col">Department</th>
                        <th class="col">Shift</th>
                        <th class="col">UserName</th>
                        <th class="col">Operations</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    include("../../../Backend/Database/connection.php");
                    $i = 1;
                    $query = "";
                    if (isset($_POST["SearchUserBtn"])) {
                        $searchText = $_POST["SearchUser"];

                        $query = "SELECT Emp_Id, First_Name, Last_Name, Department, Shift, Pnumber FROM `tbladdemployee` WHERE Emp_Id LIKE '{$searchText}%' OR First_Name LIKE '{$searchText}%' OR Last_Name LIKE '{$searchText}%' OR Department LIKE '{$searchText}%' OR Shift LIKE '{$searchText}%' OR Pnumber LIKE '{$searchText}%' ;";
                    } else {
                        $query = "SELECT Emp_Id, First_Name, Last_Name, Email, Department, Shift, Pnumber FROM `tbladdemployee`";
                    }
                    $depart = "SELECT name from `tbldepartment`";
                    $departResult = mysqli_query($conn, $depart);
                    if ($departResult) {
                        while ($row = mysqli_fetch_assoc($departResult)) {
                            $departName = $row['name'];
                        }
                    }
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Emp_Id = $row['Emp_Id'];
                            $name = $row['First_Name'];
                            $lastname = $row['Last_Name'];
                            $Department = $row['Department'];
                            $Shift = $row['Shift'];
                            $Phone_Number = $row['Pnumber'];
                            echo
                            '<tr>
                                <th scope="row" align="center">' . $i++ . '</th>
                                <td>' . $name . '</td>
                                <td>' . $lastname . '</td>
                                <td>' . $Department . '</td>
                                <td>' . $Shift . '</td>
                                <td>
                                    <button><a href="../User/add-users.php?emp_id=' . $Emp_Id . '" class="text-primary" style="text-decoration:none"><i class="fas fa-solid fa-id-card-clip me-2"></i>Add Username</button>
                                </td>
                                <td>
                                    <button><a href="../../../Backend/Update/update-add-employee.php? updateid=' . $Emp_Id . '" class="text-success"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></a></button>
                                    <button><a href="../../../Backend/Update/delete-add-employee.php? deleteid=' . $Emp_Id . '" class="text-info mx-1"><i class="fa-solid fa-info fa-1x"></i></i></a></button>
                                    <button><a href="../../../Backend/Update/delete-add-employee.php? deleteid=' . $Emp_Id . '" class="text-danger"><i class="fa-solid fa-trash fa-1x"></i></i></a></button>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <link rel="stylesheet" href="">
    </div>
</body>

</html>