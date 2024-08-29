<?php
session_start();
?>

<?php
include("../Backend/Database/connection.php");
if (isset($_POST['btnAdmin'])) {
  $email = $_POST['MailId'];
  $password = $_POST['Passkey'];
  $q = "select id from tbladdadmin where User_Name='$email' and Password='$password'";
  $r = mysqli_query($conn, $q);
  $adminId;
  if (mysqli_num_rows($r) == 1) {
    while ($row = mysqli_fetch_assoc($r)) {
      $adminId = $row['id'];
      $_SESSION['AdminId'] = $adminId;
    }
    header("location:MainDashbord.php");
  } else {
    echo "<script>alert('Invalid Username And Password');</script>";
    echo "Error found : " . mysqli_error($conn);
  }
} else if (isset($_POST['btnEmployee'])) {
  $email = $_POST['empUsername'];
  $password = $_POST['empPassword'];
  $q = "select Emp_Id from `tbladdemployee` where `email`='$email' and `password`='$password'";
  $r = mysqli_query($conn, $q);
  $employeeId;
  if (mysqli_num_rows($r) == 1) {
    while ($row = mysqli_fetch_assoc($r)) {
      $employeeId = $row['Emp_Id'];
      echo $employeeId;
      $_SESSION['EmployeeId'] = $employeeId;
      echo $_SESSION["EmployeeId"];
    }
    header("location:../Employee/EmployeeDashbord.php");
  } else {
    echo "<script>alert('Invalid Username And Password');</script>";
    echo "Error found : " . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script
    src="https://kit.fontawesome.com/81aa89284e.js"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../src/css/style-login-selector.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="#" method="POST" class="sign-in-form">
          <h2 class="title">Hello! Employee</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" name="empUsername" placeholder="Please Enter Your Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="empPassword" placeholder="Please Enter Your Password" />
          </div>
          <input type="submit" value="Login" name="btnEmployee" class="btn solid" />
          <p>
            <label for=""><input type="checkbox" style="margin: 5px;">Remember Me</label>
            <a href="forgotPassword.php" style="text-decoration: none;">Forgot password?</a>
          </p>
          <p>Don't have an account? <a href="contact.php" class="register-link" style="text-decoration: none;">Ask admin or management</a></p>
          <p class="social-text">Follow Us On Social Platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
        <form action="#" method="POST" class="sign-up-form">
          <h2 class="title">Hello! Admin</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" name="MailId" placeholder="Please Enter Your Username" autocomplete="FALSE" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="Passkey" placeholder="Please Enter Your Password" autocomplete="FALSE" />
          </div>
          <input type="submit" class="btn" name="btnAdmin" value="Sign in" />
          <p class="social-text">Or Sign up with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Please Log-In According To Your Roll</h3>
          <p>
            For Admin! Login Please Click On Below Button
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Log-In As Admin
          </button>
        </div>
        <img src="../src/Images/svg/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Please Log-In According To Your Roll</h3>
          <p>
            For Employee! Login Please Click On Below Button
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Log-In As Employee
          </button>
        </div>
        <img src="../src/Images/svg/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="../src/Javascript/loginselector.js"></script>
</body>

</html>