<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display-Location</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
</head>
<a href="../add-department.php"></a>
<body>
    <div class="container-fluid">
        <section class="main">
            <div class="main-top">
                <!-- <h1>Location</h1>
                <li><a href="../../Dist/MainDashbord.php">
                    <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                    <h6>Logout</h6>
                    </a>
                </li> -->
            </div>

            <section class="attendance-depart">
                <div class="department-list">
                    <h4>Data Tables Location</h4>
                    <table class="table">
                        <thead>
                            <tr> 
                                <th>#</th>
            
                                <th>Location Name</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                include('../../../Backend/Database/connection.php');
                                $q="SELECT * FROM `tblocation`";
                                $result = mysqli_query($conn, $q);
                                if ($result)
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                            
                                        $LocationName = $row['Location_Name'];
                                        echo
                                        '<tr>
                                            <th>' . $i++ . '</th>

                                                <td>' . $LocationName . '</td>
                                            <td>
                                                <button><a href="../../Backend/Update/update-add-admin.php? updateid=' . $LocationName . '" class="text-light"><i class="fa-solid fa-pen-to-square fa-2x"></i></i></a></button>
                                                <button><a href="../../Backend/Update/delete-add-admin.php? deleteid=' . $LocationName . '" class="text-light"><i class="fa-solid fa-trash fa-2x"></i></button>
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
                                    <button><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <button class="btnAddDepartment" onclick="location.href='../Location/add-location.php'"><i class="fa-solid fa-square-plus"></i><h6>Add New Location</h6></button>
                </div>
            </section>
        </section>
    </div>
</body>

</html>