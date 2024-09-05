<!-- =========== Code to View Data Start========== -->
<?php 
    include("../Backend/Database/connection.php");
    $admin_Id=$_GET['updateid'];

    $sql="SELECT * FROM `tbladdadmin` where Id=$admin_Id";
    $displaysql=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($displaysql);
    $Firstname=$row['First_Name'];
    $Lastname=$row['Last_Name'];
    $Department=$row['Department'];
    $Shift=$row['Shift_Name'];
    $Pnumber=$row['Phone_Number'];
    $Address=$row['Address'];
?>
<!-- =========== Code to View Data End ========== -->

<!-- =========== Code to Update Data Start ========== -->
<?php
include("../Backend/Database/connection.php");
    $admin_Id=$_GET['updateid'];
    if (isset($_POST['btn'])) {
    $First_Name = $_POST['Fname'];
    $Last_Name = $_POST['Lname'];
    $Department = $_POST['Department'];
    $Shift_Name = $_POST['shift'];
    $Phone_Number = $_POST['Phone_Number'];
    $Address = $_POST['Address'];

    $addAdminQueary = "update `tbladdadmin` set First_Name='$First_Name',Last_Name='$Last_Name',Department='$Department',Shift_Name='$Shift_Name',Phone_Number='$Phone_Number',Address='$Address' where Id=$admin_Id";
    $result = mysqli_query($conn, $addAdminQueary);
    if ($result) {
        header('location:display-add-Admin.php');
    } else {
        echo "<script>alert('Record not Updated');</script>";
    }
}
?>
<!-- =========== Code to Update Data end ========== -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
    <title>Update Admin Page</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="../src/Images/svg/undraw_shopping_re_3wst.svg" alt="">
        </div>
        <div class="form">
            <form method="POST" onsubmit="return validateForm()">
                <h2>Administrator Master Data</h2>
                <div class="content">
                    <p>Form To Update Administrator Data To System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">First Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" value="<?php echo $Firstname; ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" value="<?php echo $Lastname; ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="depart">Department</label>
                            <select class="option" name="Department" required>
                                <option value="default" disabled>Select Department</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Name FROM `tbldepartment`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = $row['Id'] == $Department ? 'selected' : '';
                                        echo "<option value='{$row['Id']}' $selected>{$row['Name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="shift">Shift</label>
                            <select class="option" name="shift" required>
                                <option value="default" disabled>Select Shift</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Shift_Name FROM `tblshift`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = $row['Id'] == $Shift ? 'selected' : '';
                                        echo "<option value='{$row['Id']}' $selected>{$row['Shift_Name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Your Phone Number" name="Phone_Number" value="<?php echo $Pnumber; ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="address">Address</label>
                            <input type="text" placeholder="Enter Your Address" name="Address" value="<?php echo $Address; ?>" required>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i> Update Admin Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var phone = document.forms[0]["Phone_Number"].value;
            var department = document.forms[0]["Department"].value;
            var shift = document.forms[0]["shift"].value;

            // Validate phone number (e.g., only digits and length of 10 digits)
            var phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            // Validate dropdown selection
            if (department === "default") {
                alert("Please select a valid department.");
                return false;
            }

            if (shift === "default") {
                alert("Please select a valid shift.");
                return false;
            }

            return true; // If all validations pass
        }
    </script>
</body>

</html>
