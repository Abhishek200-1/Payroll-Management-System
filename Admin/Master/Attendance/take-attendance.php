<?php
include("../../../Backend/Database/connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="attendance.css">
    <link rel="icon" type="image/png" href="../../../../Employee/image/favicon.png">
    <title>Take Attendance</title>
</head>

<body>
    <div class="container-fluid">
        <div class="table-uppar">
            <div class="Button-container">
                <button type="button" class="btn btn-light" onclick="location.href='display-add-attendance.php'"><i class="fa-solid fa-arrow-left me-2"></i>Go Back</button>
            </div>
            <form>
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" required autocomplete="off" name="SearchAdmin">
                    <button class="btn btn-outline-light" name="SearchAdminBtn" type="submit">Search</button>
                </div>
            </form>
        </div>
        <form method="POST" action="save_attendance.php">
            <div class="table-body">
                <h4>Take Today's Attendance</h4>
                <div class="form-floating mb-3 ps-3 mt-2" style="margin-left: 620px;">
                    <input type="date" class="form-control ps-3" id="attendance_date" name="attendance_date" min="<?php echo date('Y-m-d'); ?>" required value="<?php echo date('Y-m-d'); ?>">
                    <label class="ms-3" for="attendance_date">Select Attendance Date</label>
                </div>
                <table class="col-xs-7 table table-striped table-condensed table-fixed">
                    <thead class="table-info">
                        <tr>
                            <th class="col">Emp Id</th>
                            <th class="col">First Name</th>
                            <th class="col">Last Name</th>
                            <th class="col">Department</th>
                            <th class="col">Present</th>
                            <th class="col">Leave</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $result = $conn->query("SELECT * FROM `tbladdemployee` WHERE status='active'");
                        while ($row = $result->fetch_assoc()) {
                            echo
                            "<tr>
                                <td>{$row['Emp_Id']}</td>
                                <td>{$row['First_Name']}</td>
                                <td>{$row['Last_Name']}</td>
                                <td>{$row['Department']}</td>
                                <td><input type='checkbox' name='attendance[{$row['Emp_Id']}]' value='present'></td>
                                <td>
                                    <select name='leave[{$row['Emp_Id']}]'>
                                        <option value=''>No Leave</option>
                                        <option value='leave'>Leave</option>
                                    </select>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button class="addattendance btn btn-light" type="submit"><i class="fa-solid fa-floppy-disk me-2"></i>Save Attendance</button>
            </div>
        </form>
    </div>
</body>

</html>