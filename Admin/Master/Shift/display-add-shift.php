<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../src/css/display-table-only.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <link rel="stylesheet" href="">
        <div class="table-body">
            <h4>Admin Master Table</h4>
            <button class="add btn btn-light" type="submit" onclick="location.href='add-shift.php'"><i class="fa-solid fa-plus me-2"></i>   Add New Department</button>
            <table class="col-xs-7 table table-striped table-condensed table-fixed">
                <thead class="table-info">
                    <tr>
                        <th class="col">Sr. No</th>
                        <th class="col">Id</th>
                        <th class="col">Shift Name</th>
                        <th class="col">Shift Start Time</th>
                        <th class="col">Shift End Time</th>
                        <th class="col">Operations</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
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
                                        <th>' . $i++ . '</th>
                                        <th>' . $Id . '</th>
                                        <td>' . $ShiftName . '</td>
                                        <td>' . $ShiftStartTime . '</td>
                                        <td>' . $ShiftEndTime . '</td>
                                        <td>
                                            <button><a href="update-shift.php? updateid=' . $Id . '" class="text-success"><i class="fa-solid fa-pen-to-square fa-2x"></i></i></a></button>
                                            <button><a href="delete-add-shift.php? deleteid=' . $Id . '" class="text-danger"><i class="fa-solid fa-trash fa-2x"></i></button>
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