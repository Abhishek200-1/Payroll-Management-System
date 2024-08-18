<?php
            include("../../../Backend/Database/connection.php");
            if(isset($_POST['btn']))
        {
            $ShiftName=$_POST['shiftName'];
            $StartTime=$_POST['startTime'];
            $EndTime=$_POST['endTime'];


            
            
            $q="insert into `tblshift` (Shift_Name,Start_Time,End_Time) values ('$ShiftName','$StartTime','$EndTime')";
            $result=mysqli_query($conn,$q);
            if($result)
            {
                  // echo "<script>alert('Record Inserted Successfully');</script>";
                  header('location:../Shift/display-add-shift.php');
            }
            else
            {
                echo "Error found : " . mysqli_error($conn);
            }
        }

    ?>

<?php
    include("../../../Database/connection.php");
    $id=$_GET['updateid'];
    $sql2="SELECT * FROM `tbladdadmin` where Id=$id";
    $updateresult=mysqli_query($conn, $sql2);
    $row=mysqli_fetch_assoc($updateresult);
    $First_Name=$row['First_Name'];
    $lastname = $row['Last_Name'];
    $username = $row['User_Name'];
    $password = $row['Password'];
    $email = $row['Email'];
    $Phone_Number = $row['Phone_Number'];
    $Address=$row['Address'];
    $Dob=$row['Date_Of_Birth'];
    $Gender=$row['Gender'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/department.css">
</head>

<body>
    <div class="container-fluid">
        <section class="main">
            <div class="main-top">
                <!-- <h1>Department</h1> -->
                <!-- <li><a href="">
                    <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                    <h6>Logout</h6>
                    </a>
                </li> -->
            </div>
            
            <section class="attendance">
                <div class="department-entry">
                    <h3>Shift Master Data</h3>
                    <form method="POST">
                        <h2>Add New Shift</h2>
                        <p>Form To Add New Shift To System</p>
                        <div class="content">
                             <div class="input-box">
                                 <label for="name">Shift Name : </label>
                                 <input type="text" placeholder="Enter Your First Name" name="shiftName" required> 
                            </div>
         
                            <div class="input-box">
                                <label for="name">Shift Start Time</label>
                                <input type="time" placeholder="Enter Your First Name" name="startTime" required> 
                            </div>

                            <div class="input-box">
                                <label for="name">Shift End Time</label>
                                <input type="time" placeholder="Enter Your First Name" name="endTime" required> 
                            </div>
                        </div>

                        <div class="alert">
                            <p>By Clicking Add Button, You Are Going To Add New Shift</p>
                        </div>
                        <button class="btnAddDepartment-add"  name="btn"><i class="fa-solid fa-square-plus"></i><h6>Add New Shift</h6></button>
                        
                    </form>
                </div>
            </section>
        </section>
    </div>
</body>

</html>