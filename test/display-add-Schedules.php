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
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
        </div>
    </nav>
    <div class="my-5 mx-2">
        <div class="button-container">
            <button type="button" class="btn btn-info"><a href="../add-Schedules.php">Add New Schedule</a></button>
        </div>
        <h3>Schedule Lists</h3>
        <div class="container-fluid">
        <table class="table table-hover border-primary table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Sr Number</th>
                    <th scope="col">Shift Naame</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                <?php
                    include('../../Backend/Database/connection.php');
                    $q="SELECT * FROM `tblschedule`";
                    $result = mysqli_query($conn, $q);
                    if ($result) 
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $Sr_Number=$row['Id'];
                            $Shift_Name = $row['Shift_Name'];
                            $Time_In = $row['Time_In'];
                            $Time_Out = $row['Time_Out'];
                            echo
                            '<tr>
                                <th scope="row">' . $Sr_Number . '</th>
                                    <td>' . $Shift_Name . '</td>
                                    <td>' . $Time_In . '</td>
                                    <td>' . $Time_Out . '</td>
                                <td>
                                    <button class="btn btn-primary"><a href="../../Backend/Update/update-add-schedule.php? updateid=' . $Sr_Number . '" class="text-light">Update</a></button>
                                    <button class="btn btn-danger"><a href="../../Backend/Update/delete-add-schedules.php? deleteid=' . $Sr_Number . '" class="text-light">Delete</a></button>
                                </td>
                            </tr>';
                        }
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
