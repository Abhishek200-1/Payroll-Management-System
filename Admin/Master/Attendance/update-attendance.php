<?php
include('../../../Backend/Database/connection.php');

$attendanceDate = $_POST['attendance_date'];
$attendance_data = isset($_POST['attendance']) ? $_POST['attendance'] : [];
$leave_data = isset($_POST['leave']) ? $_POST['leave'] : [];


foreach ($_POST['attendance'] as $empId => $attendance_data) {
    $leaveStatus = isset($_POST['leave'][$empId]) ? $_POST['leave'][$empId] : '';

    $isPresent = ($leaveStatus == 'leave') ? 'absent' : 'present';
    $attendanceQuery = "INSERT INTO tbladdattendance (Emp_Id, Date, Is_Present) VALUES ('$empId', '$attendanceDate', '$isPresent')";
    $conn->query($attendanceQuery);
}
echo "<script>alert('Attendance has been recorded successfully.');</script>";
header("location:./display-add-attendance.php");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="form-floating mb-3 ps-3 mt-2" style="margin-left: 620px;">
        <input type="date" class="form-control ps-3" id="attendance_date" name="attendance_date" min="<?php echo date('Y-m-d'); ?>" required value="<?php echo date('Y-m-d'); ?>">
        <label class="ms-3" for="attendance_date">Select Attendance Date</label>
    </div>
    <table class="col-xs-7 table table-striped table-condensed table-fixed">
        <thead class="table-info">
            <tr align="center">
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
                "<tr align='center'>
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
</body>

</html>