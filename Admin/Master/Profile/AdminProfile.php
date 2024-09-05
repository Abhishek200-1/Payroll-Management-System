<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style-adminprofile.css">
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
    <title>Admin Profile Page</title>
</head>
<body>
    <div class="container">
        <h2>Profile Setting</h2>
        <div class="conetnt">
        <p>Select the Field name to update</p>
        <div class="form">
                <div class="content">
                    <!-- <div class="personal-details"> -->
                        <div class="input-box">
                            <label for="name">Fisrt Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="Fname" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="Lname" required>
                        </div>

                        <div class="input-box">
                            <label for="name">Employee image</label>
                            <input type="file" placeholder="Enter Your First Name" data-parsley-trigger="keyup" name="Image" class="form-control" required />
                        </div>

                        <div class="input-box">
                            <label for="Email">Email</label>
                            <input type="text" placeholder="Enter Your Email" name="mail" required>
                        </div>
                    <!-- </div> -->

                    <div class="input-box">
                        <label for="depart">Department</label>
                        <!-- <input type="text" placeholder="Enter Your Department" name="depart" required> -->
                        <select class="option" name="depart">
                            <option value="default">Select Department</option>
                                <?php
                                    include("../Backend/Database/connection.php");
                                    $query = "SELECT Id, Name FROM `tbldepartment`";
                                    $result = mysqli_query($conn, $query);

                                    if ($result) 
                                    {
                                        while ($row = mysqli_fetch_assoc($result)) 
                                        {
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

                                    if ($result) 
                                    {
                                        while ($row = mysqli_fetch_assoc($result)) 
                                        {
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
                        <input type="radio" name="gender" id="Male">
                        <label>Male</label>
                        <input type="radio" name="gender" id="Female">
                        <labe>Female</labe>
                        <input type="radio" name="gender" id="Other">
                        <label>Other</label>
                    </div>
                </div>
                <div class="button-container">
                    <button type="submit" name="btn"><i class="fa-solid fa-square-plus"></i>Click To Update</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>