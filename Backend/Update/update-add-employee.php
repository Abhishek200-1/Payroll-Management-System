<?php
            include("../Database/connection.php");
            $Emp_Id = $_GET['updateid'];
            if (isset($_POST['btn'])) {
                $Firstname = $_POST['Fname'];
                $Lastname = $_POST['Lname'];
                $Email = $_POST['mail'];
                $Department = $_POST['depart'];
                $Shift = $_POST['shift'];
                $Pnumber = $_POST['PhoneNum'];
                $Address = $_POST['address'];
                $Dateofbirth = $_POST['DOB'];
                $Dateofjoining = $_POST['DOJ'];
               //  $Gender = $_POST['gender'];


                $q = "update `tbladdemployee` set Emp_Id=$Emp_Id,First_Name='$Firstname',Last_Name='$Lastname',Email='$Email',Department='$Department',Shift='$Shift',Pnumber='$Pnumber',Address='$Address',Date_Of_Birth='$Dateofbirth',Date_Of_Joining='$Dateofjoining'";
                $result = mysqli_query($conn, $q);
                if ($result) {
                    echo "<script>alert('Record Inserted Successfully');</script>";
                    // header('location:../../Admin/Master/Employee/display-add-employee.php');
                }
                else
                {
                    echo "Error found : " . mysqli_error($conn);
                }
            }
        ?>


<!-- Php code view data in table -->
<?php
include("../Database/connection.php");

$sql2 = "SELECT * FROM `tbladdemployee` where Emp_Id=$Emp_Id";
$updateresult = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($updateresult);

$Emp_Id = $row['Emp_Id'];
$name = $row['First_Name'];
$lastname = $row['Last_Name'];
$Email = $row['Email'];
$Shift = $row['Shift'];
$Phone_Number = $row['Pnumber'];
$Address = $row['Address'];
$Department = $row['Department'];
$Dob = $row['Date_Of_Birth'];
$Doj = $row['Date_Of_Joining'];
// $Gender = $row['Gender'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/style-emp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h2>Employee Master Data</h2>
            <div class="content">
                <p>Form To Update Employee Details In System</p>
                <div class="content">
                    <div class="input-box">
                        <label for="name">Fisrt Name</label>
                        <input type="text" placeholder="Enter Your First Name" name="Fname" value=<?php echo $name; ?> required>
                    </div>

                <div class="input-box">
                    <label for="name">Last Name</label>
                    <input type="text" placeholder="Enter Your Last Name" name="Lname" value=<?php echo $lastname; ?> required>
                </div>

                <!-- <div class="input-box">
                    <label for="name">Employee image</label>
                    <input type="file" placeholder="Enter Your First Name" data-parsley-trigger="keyup" name="Image" class="form-control" required />
                </div> -->

                <div class="input-box">
                    <label for="Email">Email</label>
                    <input type="text" placeholder="Enter Your Email" name="mail" value=<?php echo $Email; ?> required>
                </div>

                <div class="input-box">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum" value=<?php echo $Phone_Number; ?> required>
                </div>

                <div class="input-box">
                    <label for="depart">Department</label>
                    <input type="text" placeholder="Enter Your Department" name="depart" value=<?php echo $Department; ?> required>
                    <select class="option" name="depart">
                        <option value="default">Select Department</option>
                            <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Name FROM `tbldepartment`";
                                $result = mysqli_query($conn, $query);

                                if ($result) 
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
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
                    <input type="text" placeholder="Enter Your Department" name="shift" value=<?php echo $Shift; ?> required>
                    <select class="option" name="shift">
                        <option value="default">Select Shift</option>
                            <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Shift_Name, Start_Time, End_Time FROM `tblshift`";
                                $result = mysqli_query($conn, $query);

                                if ($result) 
                                {
                                    while ($row = mysqli_fetch_assoc($result)) 
                                    {
                                        ?>
                                            <option value="<?php echo $row['Id'] ?>"><?php echo $row['Shift_Name'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                    </select>
                </div>

                <div class="input-box">
                    <label for="addresss">Address</label>
                    <input type="text" placeholder="Enter Your Address" name="address" value=<?php echo $Address; ?> required>
                </div>

                <div class="input-box">
                    <label for="Dob">Date Of Birth</label>
                    <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" value=<?php echo $Dob; ?> required>
                </div>

                <div class="input-box">
                    <label for="Dob">Date Of Joining</label>
                    <input type="date" placeholder="Enter Your Date Of Birth" name="DOJ" value=<?php echo $Doj; ?> required>
                </div>

                <!-- <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input type="radio" name="gender" id="Male">
                    <label>Male</label>
                    <input type="radio" name="gender" id="Female">
                    <labe>Female</labe>
                    <input type="radio" name="gender" id="Other">
                    <label>Other</label>
                </div> -->
            </div>
            <div class="button-container">
                <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i>Update Employee Details</button>
            </div>
            </div>
        </form>
    </div>
</body>
</html>