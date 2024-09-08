<?php
include("../../../Backend/Database/connection.php");
if (isset($_POST['btn'])) 
{
    $Firstname = $_POST['Fname'];
    $Lastname = $_POST['Lname'];
    $Email = $_POST['mail'];
    $Department = $_POST['Department'];
    $Shift = $_POST['shift'];
    $Pnumber = $_POST['Phone_Number'];
    $Address = $_POST['Address'];
    $Dateofbirth = $_POST['DOB'];
    $Dateofjoining = $_POST['DOJ'];
    $Gender = $_POST['Gender'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];


    $q = "INSERT into `tbladdemployee` (First_Name,Last_Name,Email,Department,Shift,Pnumber,Address,Date_of_Birth,Date_of_Joining,Gender,salary, status) values ('$Firstname','$Lastname','$Email','$Department','$Shift','$Pnumber','$Address','$Dateofbirth','$Dateofjoining','$Gender','$salary', '$status')";
    $result = mysqli_query($conn, $q);
    if ($result) {
        header('location:../../../Admin/Master/Employee/display-add-employee.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../../../Employee/image/favicon.png">
        <title>Admin-Employee Management</title>
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
                    <p>Form To Add New Employee To System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">Fisrt Name</label>
                            <input type="text" placeholder="Enter First Name" name="Fname" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Last Name" name="Lname" required>
                        </div>

                        <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Email" name="mail" required>
                        </div>

                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Phone Number" name="Phone_Number" required>
                        </div>

                        <div class="input-box">
                            <label for="depart">Department</label>
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

                        <div class="input-box">
                            <label for="addresss">Address</label>
                            <input type="text" placeholder="Enter Address" name="Address" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Date Of Birth</label>
                            <input type="date" placeholder="Enter Date Of Birth" name="DOB" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Date Of Joining</label>
                            <input type="date" placeholder="Enter Date Of Joining" name="DOJ" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Base Salary</label>
                            <input type="text" placeholder="Enter Salary" name="salary" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="Dob">Status</label>
                            <select class="option" name="status">
                                <option value="active" <?php echo (isset($status) && $status == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo (isset($status) && $status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <span class="gender-title">Gender</span>
                        <div class="gender-category">
                            <input type="radio" name="Gender" id="Male">
                            <label>Male</label>
                            <input type="radio" name="Gender" id="Female">
                            <labe>Female</labe>
                            <input type="radio" name="Gender" id="Other">
                            <label>Other</label>
                        </div>
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i> Add New Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>