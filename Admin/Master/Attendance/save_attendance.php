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
// Fetch all active employees
// $result = $conn->query("SELECT * FROM tbladdemployee WHERE status='active'");

// while ($row = $result->fetch_assoc()) {
//     $employee_id = $row['Emp_Id'];

//     if (isset($leave_data[$employee_id]) && $leave_data[$employee_id] == 'leave') {
//         $status = 'leave';
//     } elseif (isset($attendance_data[$employee_id])) {
//         $status = 'present';
//     } else {
//         $status = 'absent';
//     }

//     // Insert or update attendance record
//     // $sql = "INSERT INTO tbladdattendance(employee_id, Created_On, status) 
//     //         VALUES ($employee_id, '$attendance_date', '$status')
//     //         ON DUPLICATE KEY UPDATE status='$status'";
//     $attendanceQuery = "INSERT INTO tbladdattendance (Emp_Id, Date, Is_Present) VALUES ('$empId', '$currentDate', '$isPresent')
// ";
//     if ($conn->query($sql) !== TRUE) {
//         echo "Error: " . $conn->error . "<br>";
//     }
// }

// header('location:display-add-attendance.php');
$conn->close();
