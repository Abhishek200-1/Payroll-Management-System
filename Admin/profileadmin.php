<?php
session_start();
// echo $_SESSION["AdminId"];
?>

<?php
include('../Backend/Database/connection.php');

if (isset($_POST['uploadImage'])) {
    $file_name = $_FILES['profilePicture']['name'];
    $file_tmp = $_FILES['profilePicture']['tmp_name'];
    $uploadPath = '../Images/admin_image/';

    // echo $file_name . " " . $file_tmp;

    $profilePicPath = $uploadPath . $file_name;

    // echo "profilePicture path : " . $profilePicPath;

    if (move_uploaded_file($file_tmp, $uploadPath . $file_name)) {
        $sql = "UPDATE `tbladdadmin` SET adminprofile='$profilePicPath' WHERE `id`=" . $_SESSION['AdminId'] . ";";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Successfully Uploaded')</script>";
        } else {
            echo "<script>alert('Error while uploading')</script>";
        }
    } else {
        echo "Error uploading file. Check if the directory has the correct permissions";
    }
}

$id = $_SESSION['AdminId'];

$query = "SELECT `First_Name`, `Last_Name`, `User_Name`, `Phone_Number`, `Email`, `Address`, `Date_Of_Birth`, `Gender`, `adminprofile` FROM `tbladdadmin` WHERE ID = $id";

$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $FirstName = $row["First_Name"];
        $lastname =  $row["Last_Name"];
        $UserName = $row["User_Name"];
        $PhoneNumber =  $row["Phone_Number"];
        $Email =  $row["Email"];
        $Address =  $row["Address"];
        $DOB =  $row["Date_Of_Birth"];
        $Gender =  $row["Gender"];
        $adminprofile = $row["adminprofile"];
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>admin-profile</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script
        src="https://kit.fontawesome.com/81aa89284e.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/profileadmin.css" />
    <link rel="icon" type="image/png" href="../Employee/image/favicon.png">
</head>

<body>
    <div class="container-fluid">
        <section class="main">
            <div class="header--wrapper">
                <div class="title">
                    <span>Administrator</span>
                    <h2>Profile Setting</h2>
                </div>    
            </div>
            
            <section class="attendance">
                <div class="attendance-list">
                    <div class="container-form">
                        <form method="POST">
                            <!-- <h2><i class="fa-solid fa-gear"></i> Profile setting</h2> -->
                            <div class="content">
                                <div class="input-box">
                                    <label for="name">Admin Id</label>
                                    <input type="text" placeholder="Enter Your First Name" name="Fname" value=<?php echo $id; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="name">First Name</label>
                                    <input type="text" placeholder="Enter Your First Name" name="Fname" value=<?php echo $FirstName; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="name">Last Name</label>
                                    <input type="text" placeholder="Enter Your Last Name" name="Lname" value=<?php echo $lastname; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="username">User Name</label>
                                    <input type="text" placeholder="Enter Your Username" name="User_name" value=<?php echo $UserName; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="Email">Email</label>
                                    <input type="text" placeholder="Enter Your Email" name="mail" value=<?php echo $Email; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="PhoneNumber">Phone Number</label>
                                    <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum" value=<?php echo $PhoneNumber; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="addresss">Address</label>
                                    <input type="text" placeholder="Enter Your Address" name="address" value=<?php echo $Address; ?> required>
                                </div>
                                <div class="input-box">
                                    <label for="Dob">Date Of Birth</label>
                                    <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" value=<?php echo $DOB; ?> required>
                                </div>
                                <div class="gender-details">
                                    <span class="gender-title">Gender</span>
                                    <div class="gender-category">
                                        <input type="radio" name="gender" value="Male" value=<?php echo $Gender; ?>>
                                        <span>Male</span>
                                        <input type="radio" name="gender" value="Female" value=<?php echo $Gender; ?>>
                                        <span>Female</span>
                                        <input type="radio" name="gender" value="Other" value=<?php echo $Gender; ?>>
                                        <span>Other</span>
                                    </div>
                                </div>
                                <div class="header-link">
                                        <a href="forgotPassword.php"><i class="fa-solid fa-unlock"></i><span>Forgot Password</span></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="container-image">
                        <div class="card">
                            <?php
                            if ($adminprofile) {
                                echo '<img src=" ' . $adminprofile . '" alt="Card Image">';
                            } else {
                                echo '<img src="../src/Images/avatar.jpg" alt="Card Image">';
                            }
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h2 class="card-title">Admin Image</h2>
                                    <div class="input-box">
                                        <input type="file" placeholder="Enter Your First Name" data-parsley-trigger="keyup" name="profilePicture" class="form-control" required />
                                    </div>
                                    <!-- <p class="card-text">This is a brief description of the content inside the card. It can be a few lines long.</p> -->
                                    <button type="submit" name="uploadImage" class="card-button">Save Image</button>
                                </div>    
                            </form>
                        </div>
                    </div>

                </div>

                
            </section>
        </section>
    </div>
</body>

</html>