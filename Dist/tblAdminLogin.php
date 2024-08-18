<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-cum registration form</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap-4.6.2-dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="../src/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box Login">
            <h2>Hello! Admin</h2>
            <form method="get">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="Mailid" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock"></ion-icon></span>
                    <input type="password" name="Passkey" required>
                    <label>Password</label>
                </div>

                <div class="remember-forgot">
                    <label for=""><input type="checkbox">Remember Me</label>
                    <a href="forgotPassword.php">Forgot password?</a>
                </div>
                <button type="submit" class="btn" name="btn">Login</button>

                <div class="login-register">
                    <p>Don't have an account? <a href="contact.php" class="register-link">Ask admin or management</a></p>
                </div>
            </form>
        </div>
    </div>
    <?php
        include("../Backend/Database/connection.php");
        if(isset($_REQUEST['btn']))
        {
            $U=$_REQUEST['Mailid'];
            $Pass=$_REQUEST['Passkey'];
            $q="select * from tbladdadmin where User_Name='$U' and Password='$Pass'";
            $r=mysqli_query($conn,$q);
            $row=mysqli_num_rows($r);
            if($row == 1)
            {
                header("location:MainDashbord.php");
            }
            else
            {
                echo "<script>alert('Invalid Username And Password');</script>";
            }
        }
    ?>

    <script src="script.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>