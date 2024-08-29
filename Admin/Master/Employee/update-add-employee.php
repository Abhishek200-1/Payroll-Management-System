<?php 
    include("../../../Backend/Database/connection.php");
    $Emp_Id=$_GET['updateid'];

    $sql="SELECT * FROM `tbladdemployee` where Emp_Id=$Emp_Id";
    $displaysql=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($displaysql);
    $Firstname=$row['First_Name'];
    $Lastname=$row['Last_Name'];
    $Department=$row['Department'];
    $Shift=$row['Shift'];
    $Pnumber=$row['Pnumber'];
    $Address=$row['Address'];
?>

<?php
include("../../../Backend/Database/connection.php");
$Emp_Id=$_GET['updateid'];
if (isset($_POST['btn'])) 
{
    $Firstname = $_POST['Fname'];
    $Lastname = $_POST['Lname'];
    // $Email = $_POST['mail'];
    $Department = $_POST['Department'];
    $Shift = $_POST['shift'];
    $Pnumber = $_POST['Phone_Number'];
    $Address = $_POST['Address'];
    // $Dateofbirth = $_POST['DOB'];
    // $Dateofjoining = $_POST['DOJ'];
    // $Gender = $_POST['Gender'];


    $q = "update `tbladdemployee` set Emp_Id=$Emp_Id,First_Name='$Firstname',Last_Name='$Lastname',Department='$Department',Shift='$Shift',Pnumber='$Pnumber',Address='$Address' where Emp_Id=$Emp_Id";
    $result = mysqli_query($conn, $q);
    if ($result) {
        // echo "<script>alert('Record Inserted Successfully');</script>";
        header('location:display-add-employee.php');
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
    <link rel="stylesheet" href="../../../src/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
<div class="container">
        <div class="form-image">
            <img src="../../../src/Images/svg/bussiness man.svg" alt="">
        </div>
        <div class="form">
            <form method="POST">
                <h2>Employee Master Data</h2>
                <div class="content">
                    <p>Form To Update Employee Details In System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">Fisrt Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" value=<?php echo $Firstname;?> required>
                        </div>

                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" value=<?php echo $Lastname;?> required>
                        </div>

                        <!-- <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="mail" required>
                        </div> -->

                        <div class="input-box">
                            <label for="addresss">Address</label>
                            <input type="text" placeholder="Enter Your Address" name="Address" value=<?php echo $Address;?> required>
                        </div>

                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Your Phone Number" name="Phone_Number" value=<?php echo $Pnumber;?> required>
                        </div>

                        <div class="input-box">
                            <label for="depart">Department</label>
                            <!-- <input type="text" placeholder="Enter Your Department" name="depart" required> -->
                            <select class="option" name="Department">
                                <option value="default">Select Department</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Name FROM `tbldepartment`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['Id'] ?>"><?php echo $row['Name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="addresss">Shift</label>
                            <!-- <input type="text" placeholder="Enter Your Department" name="shift" required> -->
                            <select class="option" name="shift">
                                <option value="default">Select Shift</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Shift_Name, Start_Time, End_Time FROM `tblshift`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['Id'] ?>"><?php echo $row['Shift_Name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- <div class="input-box">
                            <label for="Dob">Date Of Birth</label>
                            <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Date Of Joining</label>
                            <input type="date" placeholder="Enter Your Date Of Joining" name="DOJ" required>
                        </div>

                        <span class="gender-title">Gender</span>
                        <div class="gender-category">
                            <input type="radio" name="Gender" id="Male">
                            <label>Male</label>
                            <input type="radio" name="Gender" id="Female">
                            <labe>Female</labe>
                            <input type="radio" name="Gender" id="Other">
                            <label>Other</label>
                        </div> -->

                    </div>
                    <div class="button-container">
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i>Upadet Employee Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>