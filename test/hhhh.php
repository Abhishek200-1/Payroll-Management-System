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
            <h2>Add Employee</h2>
            <div class="content">
               <div class="input-box">
                   <label for="name">Emp Id</label>
                   <input type="text" placeholder="Enter Your First Name" name="EmpId" required> 
                </div>
         
                <div class="input-box">
                   <label for="name">Full Name</label>
                   <input type="text" placeholder="Enter Your First Name" name="Fname" required> 
                </div>

                 <div class="input-box">
                    <label for="Email">Email</label>
                    <input type="text" placeholder="Enter Your Email" name="mail" required> 
                 </div>

                 <div class="input-box">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum"required> 
                 </div>

                 <div class="input-box">
                    <label for="addresss">Address</label>
                    <input type="text" placeholder="Enter Your Address" name="address" required> 
                 </div>

                 <div class="input-box">
                    <label for="addresss">Department</label>
                    <input type="text" placeholder="Enter Your Department" name="depart" required>
                 </div>

                 <div class="input-box">
                    <label for="Dob">Date Of Birth</label>
                    <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" required>
                 </div>

                 <div class="input-box">
                    <label for="Dob">Date Of Joining</label>
                    <input type="date" placeholder="Enter Your Date Of Birth" name="DOJ" required>
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
                <button type="submit" class="btn" name="btn">Add Employee</button>
            </div>
        </form>
    </div>
    <?php
        include("../Backend/Database/connection.php");
        if(isset($_POST['btn']))
        {
            $Firstname=$_POST['Fname'];
            $Lastname=$_POST['Lname'];
            $User_Name=$_POST['User_name'];
            $Password=$_POST['passkey'];
            $Email=$_POST['mail'];
            $Pnumber=$_POST['PhoneNum'];
            $Address=$_POST['address'];
            $Department=$_POST['depart'];
            $Dateofbirth=$_POST['DOB'];
            $Dateofjoining=$_POST['DOJ'];
            $Gender=$_POST['gender'];
            
            
            $q="insert into `tbladdemployee` (First_Name,Last_Name,User_Name,Password,Email,Pnumber,Address,Department,Date_of_birth,Date_of_joining,Gender) values ('$Firstname','$Lastname','$User_Name','$Password','$Email','$Pnumber','$Address','$Department','$Dateofbirth','$Dateofjoining','$Gender')";
            $result=mysqli_query($conn,$q);
            if($result)
            {
                  // echo "<script>alert('Record Inserted Successfully');</script>";
                  header('location:../Admin/Display/display-add-employee.php');
            }
        }

    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>