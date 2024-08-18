<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="../src/css/style-con.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-con">
        <form method="get">
            <h1>Contact us form</h1>
            <input type="text" name="Firstname" placeholder="Enter First Name" required>
            <input type="text" name="Lastname" placeholder="Last First Name" required>
            <input type="text" name="Mail" placeholder="Enter Email" required>
            <input type="text" name="Mobile" placeholder="Enter Contact Number" required>
            <h4>Type Your Massage Here</h4>
            <textarea  name="Inquiry" required></textarea>
            <input type="submit" value="Send" class="btn45 btn-primary" name="btnsend">
        </form>
    </div>

    <?php
        include("../Backend/Database/connection.php");
        if(isset($_REQUEST['btnsend']))
        {
            $First_Name=$_REQUEST['Firstname'];
            $Last_Name=$_REQUEST['Lastname'];
            $Email=$_REQUEST['Mail'];
            $Contact_Number=$_REQUEST['Mobile'];
            $Text_Area=$_REQUEST['Inquiry'];
            $q="insert into tblcontact values ('$First_Name','$Last_Name','$Email','$Contact_Number','$Text_Area')";
            if(mysqli_query($conn,$q))
            {
                echo "<script>alert('Inquiry Sended Successfully');</script>";
                header('location:AdminDashbord.php');
            }
        }

    ?>
</body>
</html>