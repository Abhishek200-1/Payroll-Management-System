<?php
            include("../Backend/Database/connection.php");
            if (isset($_POST['btn'])) {
                $Username = $_POST['Username'];
                $Password = $_POST['Password'];
                // $Email = $_POST['mail'];
                // $Department = $_POST['depart'];
                // $Shift = $_POST['Shift_Name'];
                // $Pnumber = $_POST['PhoneNum'];
                // $Address = $_POST['address'];
                // $Dateofbirth = $_POST['DOB'];
                // $Dateofjoining = $_POST['DOJ'];
               //  $Gender = $_POST['gender'];


                $q = "update `tbladdadmin` set Id=$admin_Id,User_Name='$Username',Password='$Password'";
                $result = mysqli_query($conn, $q);
                if ($result) {
                    // echo "<script>alert('Record Inserted Successfully');</script>";
                    header('location:display-add-admin.php');
                }
            }
        ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style-emp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h2>Admin UserName Master Data</h2>
            <div class="content">
                <p>Form To Update Admin Details In System</p>
                <div class="content">
                    <div class="input-box">
                        <label for="name">User Name</label>
                        <input type="text" placeholder="Enter Your First Name" name="Username" required>
                    </div>

                    <div class="input-box">
                        <label for="name">Password</label>
                        <input type="password" placeholder="Enter Your Last Name" name="Password" required>
                    </div>

                <!-- <div class="input-box">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum" value=<?php echo $Phone_Number; ?> required>
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
                </div> -->

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
                <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i>AssiGN Username</button>
            </div>
            </div>
        </form>
    </div>
</body>
</html>