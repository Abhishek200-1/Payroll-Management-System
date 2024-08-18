<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="../src/css/sytle-add-employee.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Add Admin</h2>
            <div class="content">
                <div class="input-box">
                    <label for="name">First Name</label>
                    <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                </div>

                <div class="input-box">
                    <label for="name">Last Name</label>
                    <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                </div>

                <div class="input-box">
                    <label for="username">User Name</label>
                    <input type="text" placeholder="Enter Your Username" name="User_name" required>
                </div>

                <div class="input-box">
                    <label for="username">Password</label>
                    <input type="password" placeholder="Enter Your Password" name="passkey" required>
                </div>

                <div class="input-box">
                    <label for="Email">Email</label>
                    <input type="text" placeholder="Enter Your Email" name="mail" required>
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

                <div class="gender-details">
                    <span class="gender-title">Gender</span>
                    <div class="gender-category">
                        <input type="radio" name="gender" value="Male">
                        <span>Male</span>
                        <input type="radio" name="gender" value="Female">
                        <span>Female</span>
                        <input type="radio" name="gender" value="Other">
                        <span>Other</span>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="btn" name="btn">Add Admin</button>
            </div>
        </form>
    </div>
    <?php
    include("../Backend/Database/connection.php");
    if (isset($_POST['btn'])) 
    {
        $Firstname = $_POST['Fname'];
        $Lastname = $_POST['Lname'];
        $User_Name = $_POST['User_name'];
        $Password = $_POST['passkey'];
        $Email = $_POST['mail'];
        $Pnumber = $_POST['PhoneNum'];
        $Address = $_POST['address'];
        $Dateofbirth = $_POST['DOB'];
        $Gender = $_POST['gender'];

        $addAdminQuery = "insert into `tbladdadmin`(first_name, last_name, user_name, password, email, phone_number, address, date_of_birth, gender) values('$Firstname','$Lastname','$User_Name','$Password','$Email','$Pnumber','$Address','$Dateofbirth','$Gender')";
        $result = mysqli_query($conn, $addAdminQuery);
        if ($result) 
        {
            echo "<script>alert('Record Inserted Successfully');</script>";
            header('location:../Admin/Display/display-add-Admin.php');
        } 
        else 
        {
            echo "<script>alert('Record not Inserted');</script>";
        }

        $existingUser = "SELECT User_Name from `tbladdadmin` where user_name='$User_Name'";
        if (mysqli_query($conn, $existingUser)) 
        {
            echo "<script>alert('User name already exists!');</script>";
        }
    }
    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>