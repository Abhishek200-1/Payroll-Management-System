<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance</title>
    <!-- <link rel="stylesheet" href="../src/css/sytle-add-employee.css"> -->
    <link rel="stylesheet" href="../../../src/css/sytle-add-employee.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
</head>

<body>
    <div class="container">
        <form method="POST">
            <h2>Add Attendance</h2>
            <div class="content">
                <div class="input-box">
                    <label for="name">Emp Id</label>
                    <input type="text" placeholder="Enter Emp Id" name="Emp_Id" id="empId" required>
                </div>
                <div class="input-box">
                    <label for="name">First Name</label>
                    <input type="text" placeholder="Enter Your First Name" name="firstName" id="firstName" required>
                </div>
                <div class="input-box">
                    <label for="username">Last Name</label>
                    <input type="text" placeholder="Enter Your Last Name" name="lastName" id="lastName" required>
                </div>
                <div class="input-box">
                    <label for="username">In Time</label>
                    <input type="time" placeholder="Enter Employee's In-Time" name="inTime" id="inTime" required>
                </div>
                <!-- <div class="input-box">
                    <label for="Email">Out Time</label>
                    <input type="time" placeholder="Enter Your Employee's Out-Time" name="outTime" id="outTime" required>
                </div> -->
                <div class="input-box">
                    <label for="isPresent">Is Present</label>
                    <select name="isPresent" id="isPresent">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="Email">Created On</label>
                    <input type="date" placeholder="Enter Created Date" name="createdOn" id="createDate" required>
                </div>
                <!-- <div class="gender-details">
                    <span class="gender-title">Work Time</span>
                    <div class="gender-category">
                        <input type="radio" id="fullDay" name="workTime" value="fullDay">
                        <label for="fullDay">Full Day</label>
                        <input type="radio" id="halfDay" name="workTime" value="halfDay">
                        <label for="halfDay">Half Day</label>
                    </div>
                </div> -->
            </div>
            <div class="button-container">
                <button type="submit" class="btn" name="addAttendance">Add Attendance</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['addAttendance'])) {
        include("../../../Backend/Database/connection.php");
        $empId = $_POST['Emp_Id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $inTime = $_POST['inTime'];
        // $outTime = $_POST['outTime'];
        $isPresent = $_POST['isPresent'];
        echo $isPresent;
        $createdOn = $_POST['createdOn'];
        // $workTime = '';
        // if (isset($_POST['workTime'])  == 'halfDay') {
        //     $workTime = 'HalfDay';
        // } else if (isset($_POST['workTime']) == 'fullDay') {
        //     $workTime = 'FullDay';
        // }

        $query = "INSERT INTO `tbladdattendance`(Emp_Id, First_Name, Last_Name, In_Time, Created_On, Is_Present) VALUES( '$empId', '$firstName', '$lastName', '$inTime', '$createdOn','present'); ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "Attendance Added!!";
            header('location:./display-add-attendance.php');
        } else {
            echo "Error found : " . mysqli_error($conn);
        }
    }
    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>