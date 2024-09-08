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
