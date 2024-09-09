<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/display-table-only.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
    <title>display-add-department</title>
</head>

<body>
    <div class="container-fluid">
        <div class="table-uppar">
            <div class="Button-container">
                <Button type="button" class="btn btn-light" onclick="location.href='../../../Dist/MainDashbord.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</Button>
            </div>
            <form action="" method="post">
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchDepart">
                    <button class="btn btn-outline-light" name="SearchDepartBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <link rel="stylesheet" href="">
        <div class="table-body">
            <h4>Admin Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='add-department.php'"><i class="fa-solid fa-plus me-2"></i> Add New Department</button>
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr align="center">
                        <th class="col">Sr. No.</th>
                        <th class="col">Id</th>
                        <th class="col">Department Name</th>
                        <th class="col">Operations</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    include('../../../Backend/Database/connection.php');
                    $i = 1;
                    $query = "";
                    if (isset($_POST["SearchDepartBtn"])) {
                        $searchText = $_POST["SearchDepart"];
                        $query = "SELECT Id, Name FROM `tbldepartment` WHERE Id LIKE '{$searchText}%' OR Name LIKE '{$searchText}%' OR Id LIKE '{$searchText}%'";
                    } else {
                        $query = "SELECT Id, Name FROM `tbldepartment`";
                    }
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $DepartmentId = $row['Id'];
                            $DepartmentName = $row['Name'];
                            echo
                            '<tr align="center">
                                <th scope="row">' . $i++ . '</th>
                                    <td>' . $DepartmentId . '</td>
                                    <td>' . $DepartmentName . '</td>
                                    <td>
                                        <button><a href="update-add-admin.php? updateid=' . $DepartmentId . '" class="text-success"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></a></button>
                                        <button><a href="delete-department.php? deleteid=' . $DepartmentId . '" class="text-danger"><i class="fa-solid fa-trash fa-1x"></i></i></a></button>
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