<?php
    include '../../../Backend/Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $Emp_Id=$_GET['deleteid'];
    }

    $q="delete from `tbladdemployee` where Emp_Id=$Emp_Id";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        //echo "Deleted Successfully";
        header("location:display-add-employee.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>
