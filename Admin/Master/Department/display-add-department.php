<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../src/css/department.css">
</head>
<a href="../add-department.php"></a>
<body>
    <div class="container-fluid">
        <section class="main">
            <div class="main-top">
                <h1>Department</h1>
                <li><a href="">
                    <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                    <h6>Logout</h6>
                    </a>
                </li>
            </div>

            <section class="attendance-depart">
                <div class="department-list">
                    <h4>Data Tables Department</h4>
                    <table class="table">
                        <thead>
                            <tr> 
                                <th>#</th>
                                <th>Id</th>
                                <th>Department Name</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                include('../../Backend/Database/connection.php');
                                $q="SELECT * FROM `tbldepartment`";
                                $result = mysqli_query($conn, $q);
                                if ($result)
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        $DepartmentId=$row['Id'];
                                        $DepartmentName = $row['Name'];
                                        echo
                                        '<tr>
                                            <th>' . $i++ . '</th>
                                                <td>' . $DepartmentId . '</td>
                                                <td>' . $DepartmentName . '</td>
                                            <td>
                                                <button><i class="fa-solid fa-pen-to-square"></i></button>
                                                <button><i class="fa-solid fa-trash"></i></button>
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
                    <button class="btnAddDepartment" onclick="location.href='../add-department.php'"><i class="fa-solid fa-square-plus"></i><h6>Add New Department</h6></button>
                </div>
            </section>
        </section>
    </div>
</body>

</html>