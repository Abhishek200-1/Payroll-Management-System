<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/css/admin.css">
    <title>Add-Admin-Page</title>
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../../../src/Images/svg/undraw_shopping_re_3wst.svg" alt="">
        </div>
        <div class="form" >
            <form method="POST">
                <h2>Administrator Master Data</h2>
                <div class="content">
                    <p>Form To Add New Administrator To System</p>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">Fisrt Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Admin image</label>
                            <input type="file" placeholder="Enter Your First Name" name="AdminImage" required>
                        </div>

                        <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="mail" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="depart">Department</label>
                            <!-- <input type="text" placeholder="Enter Your Department" name="depart" required> -->
                            <select class="option" name="depart">
                                <option value="default">Select Department</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Name FROM `tbldepartment`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['Id'] ?>"><?php echo $row['Name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="addresss">Shift</label>
                            <!-- <input type="text" placeholder="Enter Your Department" name="shift" required> -->
                            <select class="option" name="shift">
                                <option value="default">Select Shift</option>
                                <?php
                                include("../Backend/Database/connection.php");
                                $query = "SELECT Id, Shift_Name, Start_Time, End_Time FROM `tblshift`";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['Id'] ?>"><?php echo $row['Shift_Name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="PhoneNumber">Phone Number</label>
                            <input type="text" placeholder="Enter Your Phone Number" name="PhoneNum" required>
                        </div>

                        <div class="input-box">
                            <label for="addresss">Address</label>
                            <input type="text" placeholder="Enter Your Address" name="address" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Date Of Birth</label>
                            <input type="date" placeholder="Enter Your Date Of Birth" name="DOB" required>
                        </div>

                        <div class="input-box">
                            <label for="Dob">Date Of Joining</label>
                            <input type="date" placeholder="Enter Your Date Of Birth" name="DOJ" required>
                        </div>

                        <span class="gender-title">Gender</span>
                        <div class="gender-category">
                            <input type="radio" name="Gender" id="Male">
                            <label>Male</label>
                            <input type="radio" name="Gender" id="Female">
                            <labe>Female</labe>
                            <input type="radio" name="Gender" id="Other">
                            <label>Other</label>
                        </div>
                        
                    </div>
                    <div class="button-container">
                        <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i> Add New Employee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>