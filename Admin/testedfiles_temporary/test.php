<?php
include("../../Backend/Database/connection.php");
if (isset($_POST['btn'])) {
    $First_Name = $_POST['Fname'];
    $Last_Name = $_POST['Lname'];
    // $Admin_Image=$_POST['AdminImage'];
    $Email = $_POST['mail'];
    $Department = $_POST['Department'];
    $Shift_Name = $_POST['shift'];
    $Phone_Number = $_POST['Phone_Number'];
    $Address = $_POST['Address'];
    $Date_Of_Birth = $_POST['DOB'];
    $Date_Of_Joining = $_POST['DOJ'];
    $Gender = $_POST['Gender'];

    $addAdminQuery = "insert into `tbladdadmin` (First_Name,Last_Name,Email,Department,Shift_Name,Phone_Number,Address,Date_Of_Birth,Date_Of_Joining,Gender) values ('$First_Name','$Last_Name','$Email','$Department','$Shift_Name','$Phone_Number','$Address','$Date_Of_Birth','$Date_Of_Joining','$Gender')";
    $result = mysqli_query($conn, $addAdminQuery);
    if ($result) {
        // echo "<script>alert('Record Inserted Successfully');</script>";
        header('location:display-add-Admin.php');
    } else {
        die(mysqli_error($conn));
        echo "<script>alert('Record not Inserted');</script>";
    }

    // $existingUser = "SELECT User_Name from tbladdadmin where user_name='$User_Name'";
    // if(mysqli_query($conn, $existingUser)) 
    // {
    //     echo "<script>alert('User name already exists!');</script>";
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Add-Admin-Page</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="../../src/Images/svg/undraw_shopping_re_3wst.svg" alt="">
        </div>
        <div class="form">
            <form method="POST">
                <h2>Administrator Master Data</h2>
                <div class="content">
                    <p>Form To Add New Administrator To System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">First Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                        </div>
                        <!-- <div class="input-box">
                            <label for="name">Admin image</label>
                            <input type="file" placeholder="Enter Your First Name" name="AdminImage" required>
                        </div> -->
                        <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="mail" required>
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
                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Your Phone Number" name="Phone_Number" required>
                        </div>
                        <div class="input-box">
                            <label for="addresss">Address</label>
                            <input type="text" placeholder="Enter Your Address" name="Address" required>
                        </div>
                        <div class="input-box">
                            <label for="Dob">Date Of Birth</label>
                            <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" required>
                        </div>
                        <div class="input-box">
                            <label for="Dob">Date Of Joining</label>
                            <input type="date" placeholder="Enter Your Date Of Joining" name="DOJ" required>
                        </div>
                        <div class="input-box">
                            <label for="Dob">Base Salary</label>
                            <input type="text" placeholder="Enter Your Date Of Joining" name="DOJ" required>
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