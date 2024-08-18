<?php
    include '../Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $id=$_GET['deleteid'];
    }

    $q="delete from `tbladdadmin` where Id=$id";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        //echo "Deleted Successfully";
        header("location:../../Admin/Display/display-add-admin.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>