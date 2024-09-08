<?php
session_start();
include("../Backend/Database/connection.php");
$empId = $_SESSION["EmployeeId"];
$year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
$month = isset($_GET['month']) ? (int)$_GET['month'] : date("n");
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfMonth = date('N', strtotime("$year-$month-01"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../Employee/image/favicon.png">
    <link rel="stylesheet" href="../Employee/css/employeeattendance.css">
    <title>Employee Attendance Page</title>
    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            height: 620px;
            width: 630px;
            overflow-y: auto;
            background: #f8f9fa;

        }

        .day {
            border: 1px solid #1d1d1d;
            padding: 5px; 
            font-size: 25px; 
            text-align: center;
            height: 80px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            width: 80px;
        }

        .day:hover{
            background: #2a2185;
            color: #f8f9fa;
            transition: 0.5s;
        }

        .day.present {
            background-color: #28a745;
            color: white;
        }

        .day.absent {
            background-color: #dc3545;
            color: white;
        }

        .day.empty {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="table-uppar-second">
            <button onclick="location.href='EmployeeDashboard.php'" class="btn btn-light" style="margin-right: 20px;"><i class="fa-solid fa-arrow-left me-2"></i>Back to Dashboard</button>
            <form method="GET" action="">
                <label for="month"><i class="fa-solid fa-calendar-days me-2"></i>Select Month :</label>
                <select name="month" id="month">
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $monthName = date("F", mktime(0, 0, 0, $m, 10));
                        echo '<option value="' . $m . '" ' . ($m == $month ? 'selected' : '') . '>' . $monthName . '</option>';
                    }
                    ?>
                </select>

                <label for="year"><i class="fa-solid fa-calendar-days me-2"></i>Select Year :</label>
                <select name="year" id="year">
                    <?php
                    $currentYear = date("Y");
                    for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                        echo '<option value="' . $y . '" ' . ($y == $year ? 'selected' : '') . '>' . $y . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-light">Show Attendance</button>
            </form>
        </div>

        <div class="table-body">
            <?php
            $query = "SELECT Emp_Id, DAY(Date) AS Day, Work_Time, Is_Present
                      FROM tbladdattendance 
                      WHERE Emp_Id = $empId 
                      AND YEAR(Date) = $year 
                      AND MONTH(Date) = $month 
                      ORDER BY Day";

            $result = mysqli_query($conn, $query);
            $attendanceData = array_fill(1, $daysInMonth, ['status' => '', 'work_time' => '']);
            $totalPresentDays = 0;
            $totalAbsentDays = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $day = $row['Day'];
                $attendanceData[$day] = [
                    'status' => $row['Is_Present'],
                    'work_time' => $row['Work_Time']
                ];
                if ($row['Is_Present'] == 'present') {
                    $totalPresentDays++;
                } elseif ($row['Is_Present'] == 'absent') {
                    $totalAbsentDays++;
                }
            }

            // Calculate percentages
            $totalDays = $daysInMonth;
            $presentPercentage = $totalDays > 0 ? ($totalPresentDays / $totalDays) * 100 : 0;
            $absentPercentage = $totalDays > 0 ? ($totalAbsentDays / $totalDays) * 100 : 0;
            ?>
            <div class="calendar">
                <!-- Display the days of the week -->
                <div class="day"><strong>Mon</strong></div>
                <div class="day"><strong>Tue</strong></div>
                <div class="day"><strong>Wed</strong></div>
                <div class="day"><strong>Thu</strong></div>
                <div class="day"><strong>Fri</strong></div>
                <div class="day"><strong>Sat</strong></div>
                <div class="day"><strong>Sun</strong></div>

                <!-- Empty cells for days before the start of the month -->
                <?php for ($i = 1; $i < $firstDayOfMonth; $i++): ?>
                    <div class="day empty"></div>
                <?php endfor; ?>

                <!-- Days of the month with attendance status -->
                <?php for ($day = 1; $day <= $daysInMonth; $day++): 
                    $status = $attendanceData[$day]['status'];
                    $class = '';
                    if ($status == 'present') {
                        $class = 'present';
                    } elseif ($status == 'absent') {
                        $class = 'absent';
                    }
                ?>
                    <div class="day <?php echo $class; ?>">
                        <?php echo $day; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="details">
                <div class="chart-details">
                    <p>Your Attendance for <?php echo date("F Y", mktime(0, 0, 0, $month, 1, $year)); ?></p>
                    <h5>Employee Name : </h5>
                    <h5>Employee Id : </h5>
                    <h5>Department : </h5>
                    <h5>Total Working Day's : </h5>
                    <h5>Total Working Hours : </h5>
                    <h5>Total Present Days : <?php echo $totalPresentDays; ?></h5>
                    <h5>Total Absent Days : <?php echo $totalAbsentDays; ?></h5>
                    <h5>Present Percentage : <?php echo number_format($presentPercentage, 2); ?>%</h5>
                    <h5>Absent Percentage : <?php echo number_format($absentPercentage, 2); ?>%</h5>
                </div>

                <div class="chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>

                <div class="note">
                <h2>Note :</h2>
                <p></p>
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const presentPercentage = <?php echo $presentPercentage; ?>;
        const absentPercentage = <?php echo $absentPercentage; ?>;

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent'],
                datasets: [{
                    label: 'Attendance',
                    data: [presentPercentage, absentPercentage],
                    backgroundColor: [
                        '#28a745',
                        '#dc3545',
                    ],
                    borderColor: [
                        '#fff',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.label || '';
                                if (label) {
                                    label += ': ' + tooltipItem.raw.toFixed(2) + '%';
                                }
                                return label;
                            }
                        }
                    },
                    legend: {
                        display: true
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
