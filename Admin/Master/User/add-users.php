<?php
include("../../../Backend/Database/connection.php");

$emp_id = $_GET["emp_id"]; // Assuming Emp_Id is passed as a query parameter
$fetchEmpData = "SELECT Email FROM tbladdemployee WHERE Emp_Id = $emp_id;";
$empResult = mysqli_query($conn, $fetchEmpData);

if ($empResult) {
    $row = mysqli_fetch_assoc($empResult);
    $email = $row["Email"];
}

if (isset($_POST['addUserBtn'])) {
    $User_Name = $_POST['userId'];
    $Password = $_POST['password'];
    
    // Insert Emp_Id along with User_Name and Password
    $q = "UPDATE tbladdemployee SET Password = '$Password' WHERE Emp_Id='$emp_id';";
    $result = mysqli_query($conn, $q);
    
    if ($result) {
        echo "<script>alert('Record Inserted Successfully');</script>";
        header('location:../User/display-add-users.php');
    } else {
        echo "Error found : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add-userid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/department.css">
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
</head>

<body>
    <div class="container-fluid">
        <section class="main">
            <section class="attendance">
                <div class="department-entry">
                    <h3>Users Master Data</h3>
                    <form method="POST">
                        <h2>Add New User</h2>
                        <p>Form To Add New Username To User</p>
                        <div class="content">
                            <div class="input-box">
                                <label for="name">Username</label>
                                <input type="text" placeholder="Enter Your  UserName" value="<?php echo $email; ?>" name="userId" required>
                            </div>

                            <div class="input-box">
                                <label for="name">Password</label>
                                <input type="password" placeholder="Enter Your Password" name="password" required>
                            </div>
                        </div>

                        <div class="alert">
                            <p>By Clicking Add Button, You Are Going To Assign New Username To Employee</p>
                        </div>

                        <button class="btnAddDepartment-add" name="addUserBtn"><i class="fa-solid fa-square-plus"></i>
                            <h6>Assign Username</h6>
                        </button>

                    </form>
                </div>
            </section>
        </section>
    </div>
</body>

</html>