<?php
session_start();
echo $_SESSION['AdminId'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll management system | Admin Profile</title>
</head>

<body>
    <main>
        <?php
        include('../Backend/Database/connection.php');
        $id = $_SESSION['AdminId'];

        $query = "SELECT `First_Name`, `Last_Name`, `User_Name`, `Phone_Number`, `Email`, `Address`, `Date_Of_Birth`, `Gender` FROM `tbladdadmin` WHERE ID = $id";

        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row["First_Name"] . "<br />";
                echo $row["Last_Name"] . "<br />";
                echo $row["User_Name"] . "<br />";
                echo $row["Phone_Number"] . "<br />";
                echo $row["Email"] . "<br />";
                echo $row["Address"] . "<br />";
                echo $row["Date_Of_Birth"] . "<br />";
                echo $row["Gender"] . "<br />";
            }
        }
        ?>
    </main>

</body>

</html>