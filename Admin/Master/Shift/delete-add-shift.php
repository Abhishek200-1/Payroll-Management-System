<?php
    include '../../../Backend/Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $Id=$_GET['deleteid'];
    }

    $q="delete from `tblshift` where Id=$Id";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        //echo "Deleted Successfully";
        header("location:display-add-shift.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>
