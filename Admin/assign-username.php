<?php
            include("../Backend/Database/connection.php");
            $admin_Id=$_GET['updateid'];
            if (isset($_POST['btn'])) 
            {
                // $First_Name = $_POST['Fname'];
                // $Last_Name = $_POST['Lname'];
                // $Email = $_POST['mail'];
                // $Department = $_POST['Department'];
                // $Shift_Name = $_POST['shift'];
                // $Phone_Number = $_POST['Phone_Number'];
                // $Address = $_POST['Address'];
                // $Date_Of_Birth = $_POST['DOB'];
                // $Date_Of_Joining = $_POST['DOJ'];
                // $Gender = $_POST['Gender'];
                $Username=$_POST['Username'];
                $Password=$_POST['Password'];
            
                $addAdminQueary = "update `tbladdadmin` set Id=$admin_Id,User_Name='$Username',Password=$Password where Id=$admin_Id";
                $result = mysqli_query($conn, $addAdminQueary);
                if ($result) 
                {
                    // echo "<script>alert('Record Inserted Successfully');</script>";
                    header('location:display-add-Admin.php');
                } else 
                {
                    die(mysqli_error($conn));
                    echo "<script>alert('Record not Inserted');</script>";
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
                </div>
            </div>
            <div class="button-container">
                <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i>AssiGN Username</button>
            </div>
            </div>
        </form>
    </div>
</body>
</html>