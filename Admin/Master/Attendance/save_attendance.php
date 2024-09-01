<?php
include('../../../Backend/Database/connection.php');

$attendance_date = $_POST['attendance_date'];
$attendance_data = isset($_POST['attendance']) ? $_POST['attendance'] : [];
$leave_data = isset($_POST['leave']) ? $_POST['leave'] : [];

// Fetch all active employees
$result = $conn->query("SELECT * FROM tbladdemployee WHERE status='active'");

while ($row = $result->fetch_assoc()) {
    $employee_id = $row['Emp_Id'];

    if (isset($leave_data[$employee_id]) && $leave_data[$employee_id] == 'leave') {
        $status = 'leave';
    } elseif (isset($attendance_data[$employee_id])) {
        $status = 'present';
    } else {
        $status = 'absent';
    }

    // Insert or update attendance record
    $sql = "INSERT INTO tblattandance (employee_id, attendance_date, status) 
            VALUES ($employee_id, '$attendance_date', '$status')
            ON DUPLICATE KEY UPDATE status='$status'";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $conn->error . "<br>";
    }
}

echo "Attendance has been recorded successfully.";
$conn->close();
?>
<br>
<a href="mark-attendance.php">Back to Attendance</a>
