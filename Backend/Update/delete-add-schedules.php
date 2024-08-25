<?php
    include '../Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $Sr_number=$_GET['deleteid'];
    }

    $q="delete from `tblschedule` where Id=$Sr_number";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        echo "Deleted Successfully";
        header("location:../../Admin/Display/display-add-Schedules.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>  