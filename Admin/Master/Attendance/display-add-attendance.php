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
    <?php
    // if (isset($_POST['btnSearch']))
    //     $sql = "select Id,First_Name,Address from `tbladdadmin` where Id=" . $_REQUEST['Search'];
    // $result = mysqli_query($conn, $sql);
    // if ($result) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $id = $row['Id'];
    //         $name = $row['First_Name'];
    //         $lastname = $row['Last_Name'];
    //         $username = $row['User_Name'];
    //         $password = $row['Password'];
    //         $email = $row['Email'];
    //         $Phone_Number = $row['Phone_Number'];
    //         $Address = $row['Address'];
    //         $Dob = $row['Date_Of_Birth'];
    //         $Gender = $row['Gender'];
    //         echo
    //         '<tr>
    //                     <th scope="row">' . $id . '</th>
    //                         <td>' . $name . '</td>
    //                         <td>' . $lastname . '</td>
    //                         <td>' . $username . '</td>
    //                         <td>' . $password . '</td>
    //                         <td>' . $email . '</td>
    //                         <td>' . $Phone_Number . '</td>
    //                         <td>' . $Address . '</td>
    //                         <td>' . $Dob . '</td>
    //                         <td>' . $Gender . '</td>
    //                         <td>
    //                             <button class="btn btn-primary"><a href="update.php? updateid=' . $id . '" class="text-light">Update</a></button>
    //                             <button class="btn btn-danger"><a href="delete.php? deleteid=' . $id . '" class="text-light">Delete</a></button>
    //                         </td>
    //                 </tr>';
    //     }
    // }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>