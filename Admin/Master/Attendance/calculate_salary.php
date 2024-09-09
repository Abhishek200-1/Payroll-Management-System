<?php
include('../../../Backend/Database/connection.php');

// Constants for salary components (these can be adjusted)
define('HRA_PERCENTAGE', 0.10); // 10% HRA
define('DA_PERCENTAGE', 0.05); // 5% DA
define('PF_PERCENTAGE', 0.05); // 5% PF

// Function to calculate salary components and net salary
function calculateMonthlySalary($employee_id, $month_year)
{
    global $conn;

    // Get employee base salary
    $employee_query = "SELECT salary FROM tbladdemployee WHERE Emp_Id = $employee_id";
    $employee_result = $conn->query($employee_query);
    $employee_data = $employee_result->fetch_assoc();
    $base_salary = $employee_data['salary'];
    
    // Get total days in the month
    $days_in_month = date('t', strtotime($month_year . '-01'));

    // Get attendance summary for the month
    $attendance_query = "SELECT 
            SUM(CASE WHEN Is_Present = 'present' THEN 1 ELSE 0 END) as present_days,
            SUM(CASE WHEN Is_Present = 'absent' THEN 1 ELSE 0 END) as absent_days,
            SUM(CASE WHEN Is_Present = 'leave' THEN 1 ELSE 0 END) as leave_days
        FROM tbladdattendance
        WHERE Emp_Id = $employee_id 
        AND DATE_FORMAT(date, '%Y-%m') = '$month_year'";

    $attendance_result = $conn->query($attendance_query);
    $attendance_data = $attendance_result->fetch_assoc();

    $present_days = $attendance_data['present_days'];
    $absent_days = $attendance_data['absent_days'];
    $leave_days = $attendance_data['leave_days'];

    // Calculate daily salary
    $daily_salary = $base_salary / $days_in_month;

    // Calculate total salary before deductions
    $total_salary = ($daily_salary * $present_days);

    // Calculate HRA, DA, PF
    $hra = $base_salary * HRA_PERCENTAGE;
    $da = $base_salary * DA_PERCENTAGE;
    $pf = $base_salary * PF_PERCENTAGE;

    // Calculate net salary
    $net_salary = $total_salary + $hra + $da - $pf;

    // Save salary record
    $insert_salary_query = "INSERT INTO salaries (employee_id, month_year, base_salary, hra, da, pf, total_present_days, total_absent_days, total_leave_days, total_salary, net_salary)
        VALUES ('$employee_id', '$month_year', '$base_salary', '$hra', '$da', '$pf', '$present_days', '$absent_days', '$leave_days', '$total_salary', '$net_salary')
        ON DUPLICATE KEY UPDATE 
            hra = $hra,
            da = $da,
            pf = $pf,
            total_present_days = $present_days, 
            total_absent_days = $absent_days, 
            total_leave_days = $leave_days, 
            total_salary = $total_salary,
            net_salary = $net_salary";
    try {
        if ($conn->query($insert_salary_query) === TRUE) {
            // echo "Salary record inserted/updated successfully for Employee ID: $employee_id for the month $month_year.<br>";
            echo "<p class='success-message animated'>Salary record inserted/updated successfully for Employee ID: $employee_id for the month $month_year.</p>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<p class='error-message animated'>Error: Salary data for Employee ID: $employee_id for the month $month_year already exists.</p>";
        } else {
            echo "<p class='error-message animated'>Error: " . $e->getMessage() . "</p>";
        }
    }
}

// Calculate salary for all employees for a specific month
if (isset($_POST['month_year'])) {
    $month_year = $_POST['month_year'];
    $employee_query = "SELECT Emp_Id FROM tbladdemployee WHERE status = 'active'";
    $employee_result = $conn->query($employee_query);

    while ($employee = $employee_result->fetch_assoc()) {
        calculateMonthlySalary($employee['Emp_Id'], $month_year);
    }
    echo mysqli_error($conn);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Salary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
            font-size: 2.5em;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        label {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        input[type="month"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 200px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        input[type="month"]:focus {
            border-color: #007bff;
        }

        button {
            background-color: #28a745;
            color: white;
            font-size: 1.2em;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2);
        }

        /* Message Styles */
        .success-message, .error-message {
            padding: 10px;
            margin: 20px auto;
            text-align: center;
            width: 80%;
            border-radius: 5px;
            opacity: 0;
            transform: translateY(-20px);
            animation: slideDown 0.5s forwards, fadeOut 4s 2s forwards;
        }

        .success-message {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        /* Animations */
        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            h1 {
                font-size: 2em;
            }

            form {
                padding: 20px;
            }

            input[type="month"],
            button {
                width: 100%;
                font-size: 1.1em;
            }

            .success-message,
            .error-message {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <h1>Calculate Salary</h1>
    <form method="POST" action="">
        <label for="month_year">Select Month:</label>
        <input type="month" name="month_year" required>
        <button type="submit">Calculate Salary</button>
    </form>

    <!-- JavaScript to redirect after message animation -->
    <script>
        // Function to handle redirect after a delay
        function redirectToSummaryPage() {
            // Redirect to the desired page after 6 seconds (after the message fades out)
            setTimeout(function() {
                window.location.href = 'display-add-attendance.php'; // Replace with your desired URL
            }, 6000); // 6 seconds delay
        }

        // Call the redirect function after the page has loaded
        window.onload = function() {
            redirectToSummaryPage();
        };
    </script>
</body>

</html>
