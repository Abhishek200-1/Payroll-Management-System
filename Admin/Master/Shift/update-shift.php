<?php 
    include("../../../Backend/Database/connection.php");
    $Id=$_GET['updateid'];

    $sql="SELECT * FROM `tblshift` where Id=$Id";
    $displaysql=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($displaysql);
    $ShiftName=$row['Shift_Name'];
    $StartTime=$row['Start_Time'];
    $EndTime=$row['End_Time'];

?>

<?php
            include("../../../Backend/Database/connection.php");
            $Id=$_GET['updateid'];
            if(isset($_POST['btn']))
        {
            $ShiftName=$_POST['shiftName'];
            $StartTime=$_POST['startTime'];
            $EndTime=$_POST['endTime'];


            
            $q="update `tblshift` set Id=$Id,Shift_Name='$ShiftName',Start_Time='$StartTime',End_Time='$EndTime' where Id=$Id";
            $result=mysqli_query($conn,$q);
            if($result)
            {
                  // echo "<script>alert('Record Inserted Successfully');</script>";
                  header('location:display-add-shift.php');
            }
            else
            {
                echo "Error found : " . mysqli_error($conn);
            }
        }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update-shift</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/department.css">
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
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
                                 <input type="text" placeholder="Enter Your First Name" name="shiftName" value=<?php echo $ShiftName;?> required> 
                            </div>
         
                            <div class="input-box">
                                <label for="name">Shift Start Time</label>
                                <input type="time" placeholder="Enter Your First Name" name="startTime" value=<?php echo $StartTime;?> required> 
                            </div>

                            <div class="input-box">
                                <label for="name">Shift End Time</label>
                                <input type="time" placeholder="Enter Your First Name" name="endTime" value=<?php echo $EndTime;?> required> 
                            </div>
                        </div>

                        <div class="alert">
                            <p>By Clicking Add Button, You Are Going To Add New Shift</p>
                        </div>
                        <button class="btnAddDepartment-add"  name="btn"><i class="fa-solid fa-square-plus"></i><h6>Update Shift Details</h6></button>
                    </form>
                </div>
            </section>
        </section>
    </div>
</body>

</html>