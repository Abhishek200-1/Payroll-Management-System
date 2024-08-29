<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Monthly Attendance</title>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        .submit-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Employee Attendance for August 2024</h2>

    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <?php
                    // Generate day headers for the selected month
                    $month = 8; // August
                    $year = 2024;
                    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    for ($day = 1; $day <= $days_in_month; $day++) {
                        echo "<th>$day</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sample employee data (In real-world application, fetch from database)
                $employees = [
                    ['id' => 1, 'name' => 'John Doe'],
                    ['id' => 2, 'name' => 'Jane Smith'],
                    ['id' => 3, 'name' => 'Robert Johnson'],
                    ['id' => 4, 'name' => 'Michael Williams'],
                    ['id' => 5, 'name' => 'David Brown'],
                    ['id' => 6, 'name' => 'Emily Davis'],
                    ['id' => 7, 'name' => 'Sarah Miller'],
                    ['id' => 8, 'name' => 'Daniel Wilson'],
                    ['id' => 9, 'name' => 'Matthew Moore'],
                    ['id' => 10, 'name' => 'Ashley Taylor'],
                ];

                // Loop through employees and generate rows
                foreach ($employees as $employee) {
                    echo "<tr>";
                    echo "<td>{$employee['id']}</td>";
                    echo "<td>{$employee['name']}</td>";

                    // Create attendance checkboxes for each day
                    for ($day = 1; $day <= $days_in_month; $day++) {
                        $attendance_key = "{$employee['id']}_{$day}";
                        echo "<td><input type='checkbox' name='attendance[$attendance_key]' value='Present'></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <input type="submit" class="submit-btn" value="Submit Attendance">
    </form>

    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2>Attendance Report for August 2024</h2>";
        echo "<table style='width: 90%; margin: 20px auto;'>";
        echo "<thead><tr><th>Employee ID</th><th>Employee Name</th><th>Day</th><th>Status</th></tr></thead>";
        echo "<tbody>";

        foreach ($employees as $employee) {
            for ($day = 1; $day <= $days_in_month; $day++) {
                $attendance_key = "{$employee['id']}_{$day}";
                $status = isset($_POST['attendance'][$attendance_key]) ? $_POST['attendance'][$attendance_key] : 'Absent';
                echo "<tr>";
                echo "<td>{$employee['id']}</td>";
                echo "<td>{$employee['name']}</td>";
                echo "<td>$day</td>";
                echo "<td>$status</td>";
                echo "</tr>";
            }
        }

        echo "</tbody>";
        echo "</table>";
    }
    ?>
</body>
</html>
