<?php
    include '../Backend/Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $admin_Id=$_GET['deleteid'];
    }

    $q="delete from `tbladdadmin` where Id=$admin_Id";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        //echo "Deleted Successfully";
        header("location:display-add-admin.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>