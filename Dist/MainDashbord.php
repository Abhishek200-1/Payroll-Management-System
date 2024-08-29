<?php
session_start();
include("../Backend/Database/connection.php");

if (!isset($_SESSION['AdminId'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script
        src="https://kit.fontawesome.com/81aa89284e.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/dashbord.css" />
</head>

<body>
    <?php
    $id = $_SESSION['AdminId'];

    $query = "SELECT `First_Name`, `Last_Name`, `User_Name`, `Phone_Number`, `Email`, `Address`, `Date_Of_Birth`, `Gender`, `adminprofile` FROM `tbladdadmin` WHERE ID = $id";

    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $FirstName = $row["First_Name"];
            $lastname =  $row["Last_Name"];
            $UserName = $row["User_Name"];
            $PhoneNumber =  $row["Phone_Number"];
            $Email =  $row["Email"];
            $Address =  $row["Address"];
            $DOB =  $row["Date_Of_Birth"];
            $Gender =  $row["Gender"];
            $adminprofile = $row["adminprofile"];
        }
    }
    ?>
    <div class="container-fluid">
        <!-- Side navbar -->
        <nav>
            <ul>
                <li>
                    <a href="../Admin/profileadmin.php" class="logo">
                        <?php
                        if ($adminprofile) {
                            echo '<img src=" ' . $adminprofile . '" alt="Profile Image">';
                        } else {
                            echo "<img src='../src/Images/avatar.jpg' alt='Profile Image'>";
                        }
                        ?>
                        <span class="nav-item"><?php echo $lastname . " " . $FirstName; ?></span>
                    </a>
                </li>
                <h5>Admin</h5>
                <li>
                    <a href="../Dist/MainDashbord.php">
                        <i class="fas fa-solid fa-bars pe-2"></i>
                        <span class="nav-item">Dashbord</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/display-add-Admin.php">
                        <i class="fas fa-solid fa-user-tie pe-2"></i>
                        <span class="nav-item">Admin</span>
                    </a>
                </li>
                <h5>Master</h5>
                <li>
                    <a href="../Admin/Master/Employee/display-add-employee.php">
                        <i class="fas fa-solid fa-users pe-2"></i>
                        <span class="nav-item">Employee</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/Master/User/display-add-users.php">
                        <i class="fas fa-solid fa-users-line pe-2"></i>
                        <span class="nav-item">Users</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/Master/Shift/display-add-shift.php">
                        <i class="fas fa-regular fa-calendar pe-2"></i>
                        <span class="nav-item">Shift</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/Master/Department/display-add-department.php">
                        <i class="fas fa-solid fa-building"></i>
                        <span class="nav-item">Department</span>
                    </a>
                </li>
                <li>
                    <a href="../Dist/contact.php">
                        <i class="fas fa-solid fa-comment pe-2"></i>
                        <span class="nav-item">Message</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/calculator.html">
                        <i class="fas fa-solid fa-calculator"></i>
                        <span class="nav-item">Calculator</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/Master/Attendance/display-add-attendance.php">
                        <i class="fas fa-solid fa-chart-bar pe-2"></i>
                        <span class="nav-item">Attendance</span>
                    </a>
                </li>
                <h5>Report</h5>
                <li>
                    <a href="">
                        <i class="fas fa-solid fa-database pe-2"></i>
                        <span class="nav-item">Print Report</span>
                    </a>
                </li>
                <li>
                    <a href="../Admin/Logout.php">
                        <i class="fas fa-solid fa-sign-out pe-2"></i>
                        <span class="nav-item">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="main">
            <div class="header--wrapper">
                <div class="header-title">
                    <span>Primary</span>
                    <h2>Dashbord</h2>
                </div>
            </div>
            <div class="users">
                <div class="card-sec">
                    <span><i class="fa-solid fa-building icon"></i></span>
                    <h4>Depart.</h4>
                    <div class="per-card">
                        <table>
                            <tr>
                                <?php
                                $query = "SELECT count(Name) AS department from `tbldepartment`";
                                $department = mysqli_query($conn, $query);
                                if ($department) {
                                    while ($row = mysqli_fetch_assoc($department)) {
                                ?>
                                        <td>
                                            <span><?php echo $row['department']; ?></span>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <td><span>Departments</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-sec">
                    <span>
                        <i class="fa-solid fa-right-left icon-s"></i>
                    </span>
                    <h4>Working Shifts</h4>
                    <div class="per-card">
                        <table>
                            <tr>
                                <?php
                                $query = "SELECT count(Shift_Name) AS shift from `tblshift`";
                                $shift = mysqli_query($conn, $query);
                                if ($shift) {
                                    while ($row = mysqli_fetch_assoc($shift)) {
                                ?>
                                        <td>
                                            <span><?php echo $row['shift']; ?></span>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <td><span>Shift</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-sec">
                    <span><i class="fa-solid fa-address-card icon-s"></i></span>
                    <h4>Employees</h4>
                    <div class="per-card">
                        <table>
                            <tr>
                                <?php
                                $query = "SELECT count(First_Name) AS Fname from `tbladdemployee`";
                                $shift = mysqli_query($conn, $query);
                                if ($shift) {
                                    while ($row = mysqli_fetch_assoc($shift)) {
                                ?>
                                        <td>
                                            <span><?php echo $row['Fname']; ?></span>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <td><span>Employee</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-sec">
                    <span><i class="fa-solid fa-users icon-s"></i></span>
                    <h4>Users</h4>
                    <div class="per-card">
                        <table>
                            <tr>
                                <?php
                                $query = "SELECT count(uSER_Name) AS userId from `tblusername`";
                                $shift = mysqli_query($conn, $query);
                                if ($shift) {
                                    while ($row = mysqli_fetch_assoc($shift)) {
                                ?>
                                        <td>
                                            <span><?php echo $row['userId']; ?></span>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                <td><span>Active Users</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br />
            <section class="details">
                <div class="users">
                    <div class="card-body">
                        <h4>Departments Employees</h4>
                        <table class="table-Depart">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Dept Code</th>
                                    <th>No Of Employees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body-emp">
                        <h4>Employee's Per Shift</h4>
                        <table class="table-Depart">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Shift Code</th>
                                    <th>No Of Employees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <th>ABCD</th>
                                    <th>12</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body-dis">
                        <?php
                        if ($adminprofile) {
                            echo '<img src=" ' . $adminprofile . '" alt="Profile Image">';
                        } else {
                            echo '<img src="../src/Images/avatar.jpg" alt="Profile Image">';
                        }
                        ?>
                        <h4><?php echo $lastname . " " . $FirstName; ?></h4>
                        <p>Manager</p>
                        <div class="per">
                            <table>
                                <tr>
                                    <td><span>85%</span></td>
                                    <td><span>82%</span></td>
                                </tr>
                                <tr>
                                    <td>Month</td>
                                    <td>Year</td>
                                </tr>
                            </table>
                        </div>
                        <button onclick="window.location.href = '../Admin/Profile.php'">Profile</button>
                    </div>
                </div>
            </section>
            <section class="attendance">
                <div class="attendance-list">
                    <h1>Attendance List</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>Abhishek Vishwakarma</td>
                                <td>Manager</td>
                                <td>Management</td>
                                <td>03-24-2022</td>
                                <td>08:00:AM</td>
                                <td>05:00:PM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr class="active">
                                <td>02</td>
                                <td>Vishal Dubey</td>
                                <td>Admin</td>
                                <td>Management</td>
                                <td>03-24-2022</td>
                                <td>08:00:AM</td>
                                <td>05:00:PM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr>
                                <td>03</td>
                                <td>Singh Abhishek</td>
                                <td>Accountant</td>
                                <td>Accounts</td>
                                <td>03-24-2022</td>
                                <td>08:00:AM</td>
                                <td>05:00:PM</td>
                                <td><button>View</button></td>
                            </tr>
                            <tr class="active">
                                <td>04</td>
                                <td>Jyoti Dwivedi</td>
                                <td>HOD</td>
                                <td>Management</td>
                                <td>03-24-2022</td>
                                <td>08:00:AM</td>
                                <td>05:00:PM</td>
                                <td><button>View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </div>
</body>

</html>