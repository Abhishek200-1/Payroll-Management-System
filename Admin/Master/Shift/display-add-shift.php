<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/department.css">
</head>
<a href="../add-department.php"></a>
<body>
    <div class="container-fluid">
        <section class="main">
            <div class="main-top">
                <!-- <h1>Shift</h1> -->
                <!-- <li><a href="">
                    <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                    <h6>Logout</h6>
                    </a>
                </li> -->
            </div>
            <button class="btnBack" onclick="location.href='../../../Dist/MainDashbord.php'"><i class="fa-solid fa-square-plus"></i><h6>Go Back</h6></button>
            <section class="attendance-depart">
                <div class="department-list">
                    <h4>Data Table Shift</h4>
                    <table class="table">
                        <thead>
                            <tr> 
                                <th>Id</th>
                                <th>Shift Name</th>
                                <th>Shift Start Time</th>
                                <th>Shift End Time</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                include("../../../Backend/Database/connection.php");
                                $q="SELECT * FROM `tblshift`";
                                $result = mysqli_query($conn, $q);
                                if ($result)
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        $Id=$row['Id'];
                                        $ShiftName = $row['Shift_Name'];
                                        $ShiftStartTime = $row['Start_Time'];
                                        $ShiftEndTime = $row['End_Time'];
                                        echo
                                        '<tr>
                                            <th>' . $Id . '</th>
                                                <td>' . $ShiftName . '</td>
                                                <td>' . $ShiftStartTime . '</td>
                                                <td>' . $ShiftEndTime . '</td>
                                            <td>
                                                <button><a href="../../Backend/Update/update-add-admin.php? updateid=' . $Id . '" class="text-light"><i class="fa-solid fa-pen-to-square fa-2x"></i></i></a></button>
                                                <button><a href="../../Backend/Update/delete-add-admin.php? deleteid=' . $Id . '" class="text-light"><i class="fa-solid fa-trash fa-2x"></i></button>
                                            </td>
                                        </tr>';
                                    }
                                }
                            ?>
                            <!-- <tr>
                                <td>01</td>
                                <td>ACD</td>
                                <td>Accounting Department</td>
                                <td>
                                    <button onclick=""><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <button class="btnAddDepartment" onclick="location.href='../Shift/add-shift.php'"><i class="fa-solid fa-square-plus"></i><h6>Add New Shift To System</h6></button>
                </div>
            </section>
        </section>
    </div>
</body>

</html>