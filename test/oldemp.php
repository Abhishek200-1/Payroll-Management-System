<?php
$pic_upload=0;
include("../Backend/Database/connection.php");
if (isset($_POST['btn'])) {
    $Firstname = $_POST['Fname'];
    $Lastname = $_POST['Lname'];
    $image = time().$_FILES['Image']['name'];
    if(move_uploaded_file($_FILES['Image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/Abhishek/Payroll-Management-System/Images/employee_image/'.$image)){
        $target_file=$_SERVER['DOCUMENT_ROOT'].'/Abhishek/Payroll-Management-System/Images/employee_image/'.$image;
        $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $picname=basename($_FILES['Image']['name']);
        $photo=time().$picname;
        if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType != "png" )
        {?>
            <script>
                alert("please upload image having extension .jpg/.jpeg/.png");
            </script>\
            <?php
        }
        else if($_FILES['image']['size']>20000000)
        {?>
            <script>
                alert("please image exceed the size of 2 MB");
            </script>\
            <?php 
        }
        else{
            $pic_upload=1;
        }
        if($pic_upload ==1){

        }

         
    }
    $Email = $_POST['mail'];
    $Department = $_POST['depart'];
    $Shift = $_POST['shift'];
    $Pnumber = $_POST['PhoneNum'];
    $Address = $_POST['address'];
    $Dateofbirth = $_POST['DOB'];
    $Dateofjoining = $_POST['DOJ'];
    $Gender = $_POST['gender'];


    $q = "insert into `tbladdemployee` (First_Name,Last_Name,Image,Email,Department,Shift,Pnumber,Address,Date_of_birth,Date_of_joining,Gender) values ('$Firstname','$Lastname','$image','$Email','$Department','$Shift','$Pnumber','$Address','$Dateofbirth','$Dateofjoining','$Gender')";
    $result = mysqli_query($conn, $q);
    if ($result) {
        // echo "<script>alert('Record Inserted Successfully');</script>";
        header('location:../Admin/Display/display-add-employee.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/department.css">
</head>

<body>
    <div class="container-fluid">
        <section class="main">
            <div class="main-top">
                <!-- <h1>Department</h1> -->
                <li><a href="">
                        <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                        <h6>Logout</h6>
                    </a>
                </li>
            </div>

            <section class="attendance">
                <div class="department-entry">
                    <h3>Employee Master Data</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <!-- <h2>Add New Employeee</h2> -->
                        <p>Form To Add New Employee To System</p>
                        <div class="content">
                            <div class="input-box">
                                <label for="name">Fisrt Name</label>
                                <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                            </div>

                            <div class="input-box">
                                <label for="name">Last Name</label>
                                <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                            </div>

                            <div class="input-box">
                                <label for="name">Employee image</label>
                                <input type="file" placeholder="Enter Your First Name" data-parsley-trigger="keyup" name="Image" class="form-control" required />
                            </div>

                            <div class="input-box">
                                <label for="Email">Email</label>
                                <input type="text" placeholder="Enter Your Email" name="mail" required>
                            </div>

                            <div class="input-box">
                                <label for="depart">Department</label>
                                <!-- <input type="text" placeholder="Enter Your Department" name="depart" required> -->
                                <select name="depart">
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
                                <select name="shift">
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

                            <div class="input-box">
                                <label for="PhoneNumber">Phone Number</label>
                                <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum" required>
                            </div>

                            <div class="input-box">
                                <label for="addresss">Address</label>
                                <input type="text" placeholder="Enter Your Address" name="address" required>
                            </div>

                            <div class="input-box">
                                <label for="Dob">Date Of Birth</label>
                                <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" required>
                            </div>

                            <div class="input-box">
                                <label for="Dob">Date Of Joining</label>
                                <input type="date" placeholder="Enter Your Date Of Birth" name="DOJ" required>
                            </div>

                            <span class="gender-title">Gender</span>
                            <div class="gender-category">
                                <input type="radio" name="gender" id="Male">
                                <label>Male</label>
                                <input type="radio" name="gender" id="Female">
                                <labe>Female</labe>
                                <input type="radio" name="gender" id="Other">
                                <label>Other</label>
                            </div>
                        </div>
                        <!-- <div class="alert">
                            <p>By Clicking Add Button, You Are Going To Add New Employee</p>
                        </div> -->

                        <button class="btnAddDepartment-add" name="btn"><i class="fa-solid fa-square-plus"></i>
                            <h6>Add New Employee</h6>
                        </button>
                    </form>
                </div>
            </section>
        </section>
    </div>
</body>

</html>