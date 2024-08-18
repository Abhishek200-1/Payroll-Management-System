<?php
    include("../connection.php");
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
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="css/sytle-add-employee.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h2>Update Values</h2>
            <div class="content">
                <div class="input-box">
                    <label for="name">First Name</label>
                    <input type="text" placeholder="Enter Your First Name" name="Fname" value=<?php echo $First_Name; ?> required>
                </div>

                <div class="input-box">
                    <label for="name">Last Name</label>
                    <input type="text" placeholder="Enter Your Last Name" name="Lname" value=<?php echo $lastname; ?> required>
                </div>

                <div class="input-box">
                    <label for="username">User Name</label>
                    <input type="text" placeholder="Enter Your Username" name="User_name" value=<?php echo $username; ?> required>
                </div>

                <div class="input-box">
                    <label for="username">Password</label>
                    <input type="password" placeholder="Enter Your Password" name="passkey" value=<?php echo $password; ?> required>
                </div>

                <div class="input-box">
                    <label for="Email">Email</label>
                    <input type="text" placeholder="Enter Your Email" name="mail" value=<?php echo $email; ?> required>
                </div>

                <div class="input-box">
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

                <div class="gender-details">
                    <span class="gender-title">Gender</span>
                    <div class="gender-category">
                        <input type="radio" name="gender" value="Male" >
                        <span>Male</span>
                        <input type="radio" name="gender" value="Female">
                        <span>Female</span>
                        <input type="radio" name="gender" value="Other">
                        <span>Other</span>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="btn" name="btn">Update Detailes</button>
            </div>
        </form>
    </div>
    <?php
    include("../connection.php");
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

        $existingUser = "SELECT User_Name from `tbladdadmin` where user_name='$User_Name'";
        if (mysqli_query($conn, $existingUser)) 
        {
            echo "<script>alert('User name already exists!');</script>";
        }

        $addAdminQuery = "update `tbladdadmin` set Id=$id,First_Name='$Firstname',last_name='$Lastname',User_Name='$User_Name',Password='$Password',Email='$Email',Phone_Number='$Pnumber',Address='$Address',Date_Of_Birth='$Dateofbirth',Gender='$Gender' where Id=$id";
        $result = mysqli_query($conn, $addAdminQuery);
        if ($result) 
        {
            echo "<script>alert('Record Updated Successfully');</script>";
            header('location:Display/display-add-admin.php');
        } 
        else 
        {
            echo "<script>alert('Record not Inserted');</script>";
        }
    }
    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>