<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style-dashbord.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <!-- content for sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Payroll Management System</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list"></i>
                            Dashbord
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-regular fa-user pe-2"></i>
                            Admin Management
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyles collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="../Admin/Display/display-add-Admin.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-tie pe-2"></i>
                                    Add Admin
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="../Admin/forgotPassword.php" class="sidebar-link">
                                    <i class="fa-solid fa-key pe-2"></i>
                                    Forgot Password
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-users pe-2"></i>
                            Employee Management
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyles collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" id="addEmployee">
                                <a href="../Admin/Display/display-add-employee.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-plus pe-2"></i>
                                    Employee
                                </a>
                            </li>

                            <li class="sidebar-item" id="addEmployee">
                                <a href="../Admin/Display/display-add-attendance.php" class="sidebar-link">
                                    <i class="fa-solid fa-user-plus pe-2"></i>
                                    Attandance
                                </a>
                            </li>

                            <li class="sidebar-item" id="addEmployee">
                                <a href="../Admin/Display/display-add-Schedules.php" class="sidebar-link">
                                    <i class="fa-regular fa-calendar pe-2"></i>
                                    Schedule
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="sidebar-header">
                        Multi Level Menu
                    </li> -->

                    <!-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyles collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1" data-bs-toggle="collapse" aria-expanded="false">
                                    Level 1
                                </a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyles collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>

                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <!-- <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div> -->
                </form>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="navbar-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="navbar-icon pe-md-0">
                                <img src="../Images/young.jpg" class="avatar image-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="../Dist/tblAdminLogin.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashbord</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100 ">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashbord, Pushpa</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="../Images/young.jpg" class="img-fluid illustration-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4 ">
                                    <div class="d-flex align-items-start">
                                        <div class="d-flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-4">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2 ">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0" id="table1010">
                        <div class="card-header">
                            <h5 class="card-title">
                                Enployee Detailes
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                To add number of employees please click on below button
                            </h6>
                            <div class="container-admin">
                                <button class="btn btn-primary my-3"><a href="tblRegistration.php" class="text-light">Add User</a></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id Number</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../Backend/Database/connection.php';
                                    $q = "SELECT * FROM `tblregistration`";
                                    $result = mysqli_query($conn, $q);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['Id_Number'];
                                            $name = $row['First_Name'];
                                            $lastname = $row['Last_Name'];
                                            $username = $row['User_Name'];
                                            $email = $row['Email'];
                                            $password = $row['Password'];
                                            echo
                                            '<tr>
                                            <th scope="row">' . $id . '</th>
                                            <td>' . $name . '</td>
                                            <td>' . $lastname . '</td>
                                            <td>' . $username . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $password . '</td>
                                            <td>
                                            <button class="btn btn-primary"><a href="update.php? updateid=' . $id . '" class="text-light">Update</a></button>
                                            <button class="btn btn-danger"><a href="delete.php? deleteid=' . $id . '" class="text-light">Delete</a></button>
                                            </td>
                                        </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>AbhishekVishwakarma</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="../Dist/contact.php" class="text-muted">Contacts</a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="../Dist/about.php" class="text-muted">About Us</a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="services.php" class="text-muted">Terms</a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="../Dist/contact.php" class="text-muted">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="javascript/script.js"></script>
</body>

</html>
<!-- dist > index.php
Admin > 
Employee >
Backend > 
.gitignore -->