<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display-message</title>
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../src/css/style-admin-display.css">
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
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
            <button type="button" class="btn btn-info"><a href="../add-admin.php">Add New Admin</a></button>
        </div>
        <h3>Admin Detailes</h3>
        <table class="table table-striped table-hover border-primary table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id Number</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">User Name</th>
                    <!-- <th scope="col">Password</th> -->
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Date Of Birth</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                <?php
                    include('../../Backend/Database/connection.php');
                    $q="SELECT * FROM `tbladdadmin`";
                    $result = mysqli_query($conn, $q);
                    if ($result) 
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $id = $row['Id'];
                            $name = $row['First_Name'];
                            $lastname = $row['Last_Name'];
                            $username = $row['User_Name'];
                            // $password = $row['Password'];
                            $email = $row['Email'];
                            $Phone_Number = $row['Phone_Number'];
                            $Address=$row['Address'];
                            $Dob=$row['Date_Of_Birth'];
                            $Gender=$row['Gender'];
                            echo
                            '<tr>
                                <th scope="row">' . $id . '</th>
                                    <td>' . $name . '</td>
                                    <td>' . $lastname . '</td>
                                    <td>' . $username . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $Phone_Number . '</td>
                                    <td>' . $Address . '</td>
                                    <td>' . $Dob . '</td>
                                    <td>' . $Gender . '</td>
                                <td>
                                    <button class="btn btn-primary"><a href="../../Backend/Update/update-add-admin.php? updateid=' . $id . '" class="text-light">Update</a></button>
                                    <button class="btn btn-danger"><a href="../../Backend/Update/delete-add-admin.php? deleteid=' . $id . '" class="text-light">Delete</a></button>
                                </td>
                            </tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- <?php
        include('../Database/connection.php');
        if(isset($_POST['btnSearch']))
        $sql="select Id,First_Name,Address from `tbladdadmin` where Id=".$_REQUEST['Search'];
        $result= mysqli_query($conn, $sql);
        if($result)
        {
            while ($row = mysqli_fetch_assoc($result)) 
                {
                    $id = $row['Id'];
                    $name = $row['First_Name'];
                    $lastname = $row['Last_Name'];
                    $username = $row['User_Name'];
                    $password = $row['Password'];
                    $email = $row['Email'];
                    $Phone_Number = $row['Phone_Number'];
                    $Address=$row['Address'];
                    $Dob=$row['Date_Of_Birth'];
                    $Gender=$row['Gender'];
                    echo
                    '<tr>
                        <th scope="row">' . $id . '</th>
                            <td>' . $name . '</td>
                            <td>' . $lastname . '</td>
                            <td>' . $username . '</td>
                            <td>' . $password . '</td>
                            <td>' . $email . '</td>
                            <td>' . $Phone_Number . '</td>
                            <td>' . $Address . '</td>
                            <td>' . $Dob . '</td>
                            <td>' . $Gender . '</td>
                            <td>
                                <button class="btn btn-primary"><a href="update.php? updateid=' . $id . '" class="text-light">Update</a></button>
                                <button class="btn btn-danger"><a href="delete.php? deleteid=' . $id . '" class="text-light">Delete</a></button>
                            </td>
                    </tr>';
                }
        }
    ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.js"></script>
</body>
</html>
