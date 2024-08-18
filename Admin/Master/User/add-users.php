<?php
            include("../../../Backend/Database/connection.php");
            if(isset($_POST['btn']))
        {
            $User_Name=$_POST['userId'];
            $Password=$_POST['password'];

            
            
            $q="insert into `tblusername` (User_Name,Password) values ('$User_Name','$Password')";
            $result=mysqli_query($conn,$q);
            if($result)
            {
                  // echo "<script>alert('Record Inserted Successfully');</script>";
                  header('location:../User/display-add-users.php');
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/department.css">
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
                    <h3>Users Master Data</h3>
                    <form method="POST">
                        <h2>Add New User</h2>
                        <p>Form To Add New Username To User</p>
                        <div class="content">
                             <div class="input-box">
                                 <label for="name">Username</label>
                                 <input type="text" placeholder="Enter Your  UserName" name="userId" required> 
                            </div>
         
                            <div class="input-box">
                                <label for="name">Password</label>
                                <input type="password" placeholder="Enter Your Password" name="password" required> 
                            </div>
                        </div>

                        <div class="alert">
                            <p>By Clicking Add Button, You Are Going To Assugn New Username To Employee</p>
                        </div>

                        <button class="btnAddDepartment-add" name="btn"><i class="fa-solid fa-square-plus"></i><h6>Assign Username</h6></button>
                        
                    </form>
                </div>
            </section>
        </section>
    </div>
</body>

</html>