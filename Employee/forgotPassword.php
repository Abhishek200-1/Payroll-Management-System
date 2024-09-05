<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../src/bootstrap-4.6.2-dist/bootstrap5.css">
    <link rel="stylesheet" href="../src/css/forgatepass.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 text-center">
                <img src="../src/Images/svg/main.png" alt="Main IMG" class="img-fluid">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 pt-5">
                <h2 class="main-text pt-5 mt-5">Forgot <br> Your Password</h2>
                <form method="post" action="" onsubmit="return validateForm()">
                    <input type="email" placeholder="Enter Your E-mail" class="form-control main-input mt-5" name="Mailid" required>
                    <input type="password" placeholder="Enter New Password" class="form-control main-input mt-5" name="password" required>
                    <input type="password" placeholder="Confirm New Password" class="form-control main-input mt-5" name="cpassword" required>
                    <div class="col-3">
                        <button class="btn btn-sz-primary mt-5" name="btn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function validateForm() {
            var email = document.forms[0]["Mailid"].value;
            var password = document.forms[0]["password"].value;
            var cpassword = document.forms[0]["cpassword"].value;
            
            // Email format validation using regex
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Password strength validation (at least 6 characters for this example)
            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            // Check if passwords match
            if (password !== cpassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true; // If all validations pass
        }
    </script>
    
    <?php
        include("../Backend/Database/connection.php");

        if (isset($_POST['btn'])) {
            $email = $_POST['Mailid'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if ($password != $cpassword) {
                echo "<script>alert('Password not matched!!')</script>";
            }

            $existingUserQuery = "SELECT user_name, first_name from `tbladdadmin` WHERE email='$email'";

            $existingUser = mysqli_query($conn, $existingUserQuery);
            if (!($existingUser)) {
                echo "<script>alert('User not found!!')</script>";
            }

            $query = "UPDATE `tbladdemployee` SET `Password`='$password' WHERE `Email`='$email'";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Password updated successfully!')</script>";
                header("location:EmployeeDashboard.php");
            }
        }
    ?>
</body>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap5.js"></script>
</html>
