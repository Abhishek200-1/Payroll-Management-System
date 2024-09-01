<?php include('../../../Backend/Database/connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Mark Attendance</h1>

    <!-- Attendance Form -->
    <form method="POST" action="save_attendance.php">
        <label for="attendance_date">Date:</label>
        <input type="date" name="attendance_date" required value="<?php echo date('Y-m-d'); ?>">
        <br><br>

        <!-- Display Employee List with Checkboxes -->
        <table border="1">
            <tr>
                <th>Emp ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
                <th>Present</th>
                <th>Leave</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM tbladdemployee WHERE status='active'");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
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
        </table>

        <br>
        <button type="submit">Save Attendance</button>
    </form>
</body>
</html>
