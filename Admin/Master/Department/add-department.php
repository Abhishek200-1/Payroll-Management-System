    <?php
    include("../../../Backend/Database/connection.php");
    if (isset($_POST['btn'])) {
        $DepartmentId = $_POST['departmentId'];
        $DepartmentName = $_POST['departmentName'];
        $q = "insert into `tbldepartment` (Id,Name) values ('$DepartmentId','$DepartmentName')";
        $result = mysqli_query($conn, $q);
        if ($result) {
            // echo "<script>alert('Record Inserted Successfully');</script>";
            header('location:../Admin/Display/display-add-department.php');
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/81aa89284e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../src/css/department.css">
    </head>

    <body>
        <div class="container-fluid">
            <section class="main">
                <div class="main-top">
                    <!-- <h1>Department</h1> -->
                    <li><a href="">
                            <i class="fas fa-solid fa-sign-out-alt pe-2"></i>
                            <h6>Logout</h6>
                        </a>
                    </li>
                </div>
                <section class="attendance">
                    <div class="department-entry">
                        <h3>Department Master Data</h3>
                        <form method="POST">
                            <h2>Add New Department</h2>
                            <p>Form To Add New Department To System</p>
                            <div class="content">
                                <div class="input-box">
                                    <label for="name">Department Id : </label>
                                    <input type="text" placeholder="Enter Your First Name" name="departmentId" required>
                                </div>
                                <div class="input-box">
                                    <label for="name">Department Name : </label>
                                    <input type="text" placeholder="Enter Your First Name" name="departmentName" required>
                                </div>
                            </div>
                            <div class="alert">
                                <p>By Clicking Add Button, You Are Going To Add New Department</p>
                            </div>
                            <button class="btnAddDepartment-add" name="btn"><i class="fa-solid fa-square-plus"></i>
                                <h6>Add New Department</h6>
                            </button>
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </body>

    </html>