<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/display-table-only.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="table-uppar">
            <div class="Button-container">
                <Button type="button" class="btn btn-light" onclick="location.href='../../../Dist/MainDashbord.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</Button>
            </div>
            <div class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </div>
        </div>
        <div class="table-body">
            <h4>Employee Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='add-employee.php'"><i class="fa-solid fa-plus me-2"></i>Add New Employee</button>
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr> 
                        <th class="col">Emp Id</th>
                        <th class="col">Fisrt Name</th>
                        <th class="col">Last Name</th>
                        <!-- <th>Employee Image</th> -->
                        <th class="col">Email</th>
                        <th class="col">Department</th>
                        <th class="col">Shift</th>
                        <th class="col">Phone Number</th>
                        <!-- <th>Address</th> -->
                        <th class="col">Date Of Birth</th>
                        <th class="col">Date Of Joining</th>
                        <th class="col">Gender</th>
                        <th class="col">Operations</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php   
                    $i = 1;
                    include('../../../Backend/Database/connection.php');
                    $q="SELECT * FROM `tbladdemployee`";
                    $result = mysqli_query($conn, $q);
                    if ($result) 
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $Emp_Id=$row['Emp_Id'];
                            $name = $row['First_Name'];
                            $lastname = $row['Last_Name'];
                            // $image = $row['Image'];
                            // $password = $row['Password'];
                            $email = $row['Email'];
                            $Department = $row['Department'];
                            $Shift=$row['Shift'];
                            $Phone_Number=$row['Pnumber'];
                            // $Address=$row['Address'];
                            $Dob=$row['Date_Of_Birth'];
                            $Doj=$row['Date_Of_Joining'];
                            $Gender=$row['Gender'];
                            echo
                            '<tr>
                                <th scope="row">' . $i++ . '</th>
                                    <td>' . $name . '</td>
                                    <td>' . $lastname . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $Department . '</td>
                                    <td>' . $Shift  . '</td>
                                    <td>' . $Phone_Number . '</td>
                                    <td>' . $Dob . '</td>
                                    <td>' . $Doj . '</td>
                                    <td>' . $Gender . '</td>
                                <td>
                                    <button><a href="../../../Backend/Update/update-add-employee.php? updateid=' . $Emp_Id . '" class="text-success"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></a></button>
                                    <button><a href="../../../Backend/Update/delete-add-employee.php? deleteid=' . $Emp_Id . '" class="text-info mx-1"><i class="fa-solid fa-info fa-1x"></i></i></a></button>
                                    <button><a href="delete-add-employee.php? deleteid=' . $Emp_Id . '" class="text-danger"><i class="fa-solid fa-trash fa-1x"></i></i></a></button>
                                </td>
                            </tr>';
                        }
                    }
                ?>
                </tbody> 
            </table>
            <link rel="stylesheet" href="">
        </div>
    </div>
</body>
</html>
<link rel="stylesheet" href="">