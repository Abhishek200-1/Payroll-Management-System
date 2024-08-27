<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="../../src/css/sytle-add-employee.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Add Schedule</h2>
            <div class="content">
                <div class="input-box">
                   <label for="name">Shift</label>
                   <input type="text" placeholder="Enter Shift Name" name="shift" required> 
                </div>

                <div class="input-box">
                   <label for="name">Time In</label>
                   <input type="time" placeholder="Enter Shift Name" name="Timein" required> 
                </div>

                <div class="input-box">
                   <label for="name">Time Out</label>
                   <input type="time" placeholder="Enter Shift Name" name="Timeout" required> 
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="btn" name="btn">Add Shift</button>
            </div>
        </form>
    </div>
    <?php
        include("../Database/connection.php");
        $Sr_Number = $_GET['updateid'];
        if(isset($_POST['btn']))
        {
            $Shift_Name=$_POST['shift'];
            $Time_In=$_POST['Timein'];
            $Time_Out=$_POST['Timeout'];
            $q="update `tblschedule` set Shift_Name='$Shift_Name',Time_In='$Time_In',Time_Out='$Time_Out' where Id=$Sr_Number";
            $result=mysqli_query($conn, $q);
            if($result)
            {
                //echo "<script>alert('Record Inserted Successfully');</script>";
                header('location:../../Admin/Display/display-add-Schedules.php');
            }
        }

    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>