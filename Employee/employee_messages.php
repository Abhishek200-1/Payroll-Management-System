<?php
include("../Backend/Database/connection.php"); // Include your database connection file


$departmentId = 1; 

$query = "SELECT message, created_at FROM department_messages WHERE department_id = '$departmentId' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Messages</title>
    <link rel="stylesheet" href="css/employee_message.css">
    <link rel="icon" type="image/png" href="image/favicon.png">
</head>
<body>
    <div class="container">
        <h1>Department Messages</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <li>
                        <p><strong>Administrator:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                        <p><small><?php echo htmlspecialchars($row['created_at']); ?></small></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
