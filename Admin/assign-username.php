<?php 
    include("../Backend/Database/connection.php");
    if(isset($_POST['btn']))
    {
        $User_Name=$_POST['Username'];
        $Password=$_POST['Password'];
        
        $addAdminQueary="insert into `tbladdadmin` (User_Name,Password) values ('$User_Name','$Password')";
        $result=mysqli_query($conn,$addAdminQueary);
        if($result)
        {
            // echo "<script>alert('Record Inserted Successfully');</script>";
            header('location:../Admin/Display/display-add-Admin.php');
        }
        else
        {
            die(mysqli_error($conn));
            echo "<script>alert('Record not Inserted');</script>";
        }

        $existingUser = "SELECT User_Name from tbladdadmin where user_name='$User_Name'";
        if(mysqli_query($conn, $existingUser)) 
        {
            echo "<script>alert('User name already exists!');</script>";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/admin.css">
    <title>Add-Admin-Page</title>
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../src/Images/svg/undraw_shopping_re_3wst.svg" alt="">
        </div>
        <div class="form" >
            <form method="POST">
                <h2>Administrator UserName Master Data</h2>
                <div class="content">
                    <p>Form To Add New Username To User</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">User Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Username" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Password</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Password" required>
                        </div>

                        <!-- <div class="input-box">
                            <label for="name">Admin image</label>
                            <input type="file" placeholder="Enter Your First Name" name="AdminImage" required>
                        </div> -->

                        
                    </div>
                    <div class="button-container">
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i> Add New Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>