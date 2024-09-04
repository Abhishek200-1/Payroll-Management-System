<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to Department</title>
    <link rel="stylesheet" href="../src/css/admin_message.css">
</head>
<body>
    <div class="container">
        <h1>Send Message to Department</h1>
        <form  method="post">
            <label for="department">Select Department:</label>
            <select name="department" id="department" required>
                <option value="1">HR</option>
                <option value="2">Finance</option>
                <option value="3">IT</option>
            </select>
            
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="4" required></textarea>
            
            <button type="submit">Send Message</button>
        </form>
    </div>
    <?php
include("../Backend/Database/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentId = intval($_POST['department']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO department_messages (department_id, message) VALUES ('$departmentId', '$message')";
    if (mysqli_query($conn, $query)) {
        echo "Message sent successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

</body>
</html>
