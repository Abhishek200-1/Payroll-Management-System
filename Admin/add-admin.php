<?php
include("../Backend/Database/connection.php");
if (isset($_POST['btn'])) {
    $First_Name = $_POST['Fname'];
    $Last_Name = $_POST['Lname'];
    $Email = $_POST['mail'];
    $Department = $_POST['Department'];
    $Shift_Name = $_POST['shift'];
    $Phone_Number = $_POST['Phone_Number'];
    $Address = $_POST['Address'];
    $Date_Of_Birth = $_POST['DOB'];
    $Date_Of_Joining = $_POST['DOJ'];
    $Gender = $_POST['Gender'];

    $addAdminQuery = "INSERT INTO `tbladdadmin` (First_Name, Last_Name, Email, Department, Shift_Name, Phone_Number, Address, Date_Of_Birth, Date_Of_Joining, Gender) 
                      VALUES ('$First_Name', '$Last_Name', '$Email', '$Department', '$Shift_Name', '$Phone_Number', '$Address', '$Date_Of_Birth', '$Date_Of_Joining', '$Gender')";
    $result = mysqli_query($conn, $addAdminQuery);
    if ($result) {
        header('location:display-add-Admin.php');
    } else {
        die(mysqli_error($conn));
        echo "<script>alert('Record not Inserted');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Add-Admin-Page</title>
    <style>
        /* CSS for invalid input animation */
        .invalid {
            border: 2px solid red;
            animation: shake 0.3s;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        .error-message {
            color: red;
            display: none;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
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
                    <p>Form To Add New Administrator To System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">First Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                            <div class="error-message">Please enter your first name</div>
                        </div>
                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                            <div class="error-message">Please enter your last name</div>
                        </div>
                        <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="mail" required>
                            <div class="error-message">Please enter a valid email address</div>
                        </div>
                        <div class="input-box">
                            <label for="depart">Department</label>
                            <select class="option" name="Department" required>
                                <option value="default">Select Department</option>
                                <?php
                                $query = "SELECT Id, Name FROM `tbldepartment`";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="error-message">Please select a department</div>
                        </div>
                        <div class="input-box">
                            <label for="shift">Shift</label>
                            <select class="option" name="shift" required>
                                <option value="default">Select Shift</option>
                                <?php
                                $query = "SELECT Id, Shift_Name FROM `tblshift`";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['Id']}'>{$row['Shift_Name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="error-message">Please select a shift</div>
                        </div>
                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Your Phone Number" name="Phone_Number" required>
                            <div class="error-message">Please enter a valid phone number</div>
                        </div>
                        <div class="input-box">
                            <label for="address">Address</label>
                            <input type="text" placeholder="Enter Your Address" name="Address" required>
                            <div class="error-message">Please enter your address</div>
                        </div>
                        <div class="input-box">
                            <label for="Dob">Date Of Birth</label>
                            <input type="date" name="DOB" required>
                            <div class="error-message">Please enter your date of birth</div>
                        </div>
                        <div class="input-box">
                            <label for="Dob">Date Of Joining</label>
                            <input type="date" name="DOJ" required>
                            <div class="error-message">Please enter your date of joining</div>
                        </div>
                        <span class="gender-title">Gender</span>
                        <div class="gender-category">
                            <input type="radio" name="Gender" value="Male" required> Male
                            <input type="radio" name="Gender" value="Female" required> Female
                            <input type="radio" name="Gender" value="Other" required> Other
                            <div class="error-message">Please select a gender</div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i> Add New Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll('input[required], select[required]');
            inputs.forEach(function(input) {
                if (input.value === "" || input.value === "default") {
                    input.classList.add('invalid');
                    input.nextElementSibling.style.display = 'block'; // Show error message
                    isValid = false;
                } else {
                    input.classList.remove('invalid');
                    input.nextElementSibling.style.display = 'none'; // Hide error message
                }

                // Specific validation for phone number format (10 digits)
                if (input.name === "Phone_Number") {
                    var phonePattern = /^\d{10}$/;
                    if (!phonePattern.test(input.value)) {
                        input.classList.add('invalid');
                        input.nextElementSibling.style.display = 'block'; // Show error message
                        isValid = false;
                    }
                }

                // Specific validation for email format
                if (input.name === "mail") {
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if (!emailPattern.test(input.value)) {
                        input.classList.add('invalid');
                        input.nextElementSibling.style.display = 'block'; // Show error message
                        isValid = false;
                    }
                }
            });
            return isValid;
        }
    </script>
</body>

</html>
