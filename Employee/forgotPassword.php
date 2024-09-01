<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../bootstrap-4.6.2-dist/js/bootstrap.min.js">
</head>
<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box Login">
            <h2>Forgot Password</h2>
            <form method="post" action="">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="Mailid" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="password" name="cpassword" required>
                    <label>Confirm password</label>
                </div>

                <button type="submit" class="btn" name="btn">Next</button>
            </form>
        </div>
    </div>
    <?php

    include("../Backend/Database/connection.php");

    if (isset($_POST['btn'])) {
        $email = $_POST['Mailid'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password != $cpassword) {
            echo "<script>alert('Password not matched!!')</script>";
        }

        // $existingUserQuery = "SELECT user_name, first_name from `tbladdemployee` WHERE Email='$email'";

        // $existingUser = mysqli_query($conn, $existingUserQuery);
        // if (!($existingUser)) {
        //     echo "<script>alert('User not found!!')</script>";
        // }

        $query = "UPDATE `tbladdemployee` SET `Password`='$password' WHERE `Email`='$email'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Password updated successfully!')</script>";
            header("location:EmployeeProfile.php");
        }
    }
    ?>
    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

</html>