<?php
session_start();
include("../Backend/Database/connection.php");
?>

<?php
$empId = $_SESSION["EmployeeId"];

$query = "SELECT * FROM `tbladdemployee` WHERE Emp_Id='$empId'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row["First_Name"];
        $lastname = $row["Last_Name"];
        $Emp_Id = $row["Emp_Id"];
        $EmailId = $row["Email"];
        $Number = $row["Pnumber"];
        $AddressEmp = $row["Date_Of_Joining"];
        $employeeprofile = $row["employeeprofile"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Employee Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../Employee/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title"><?php echo $firstName . " " . $lastname; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Views Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="employee_messages.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Administrator Messages</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="forgotPassword.php">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="salary_slip.html">
                        <span class="icon">
                            <ion-icon name="document-outline"></ion-icon>
                        </span>
                        <span class="title">Print Pay Slip</span>
                    </a>
                </li>
                <li>
                    <a href="Logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src='<?php echo ($employeeprofile) ?  $employeeprofile :  "../Employee/image/avatar.jpg"; ?>' alt="Profile Picture">
                </div>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">26</div>
                        <div class="cardName">Working Days</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="calendar"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">4</div>
                        <div class="cardName">Total Absent</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="today"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">25</div>
                        <div class="cardName">Department Messages</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">$15000</div>
                        <div class="cardName">Earning</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="cardBox-profile">
                <div class="card-profile">
                    <div>
                        <div class="image-profile">
                            <a href=""> <img src='<?php echo ($employeeprofile) ?  $employeeprofile :  "../Employee/image/avatar.jpg"; ?>' alt="Profile Picture"></a>
                        </div>
                        <div class="cardName-profile"><?php echo $firstName . " " . $lastname; ?></div>
                    </div>
                    <div class="Details-pro">
                        <div class="name">
                            <h3>Accountant Department</h3>
                        </div>
                        <div class="basic-details">
                            <h5>Employee Id : <?php echo $Emp_Id ?></h5>
                            <h5>Email : <?php echo $EmailId ?></h5>
                            <h5>Phone : +91-<?php echo $Number ?></h5>
                            <h5>Date Of Joining : <?php echo $AddressEmp ?></h5>
                        </div>
                        <div class="btn-view">
                            <button><a href="EmployeeProfile.php">View Profile</a></button>
                        </div>
                    </div>
                </div>
                <div class="card-profile-cal">
                    <div class="calendar">
                        <div class="header">
                            <div class="month"></div>
                            <div class="btns">
                                <div class="btn today-btn">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="btn prev-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                                <div class="btn next-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="weekdays">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="days">
                            <!-- lets add days using js -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../Employee/javascript/main.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>