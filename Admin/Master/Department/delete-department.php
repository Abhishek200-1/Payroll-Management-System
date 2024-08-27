<?php
    include '../../../Backend/Database/connection.php';
    if(isset($_GET['deleteid']))
    {
        $DepartmentId=$_GET['deleteid'];
    }

    $q="delete from `tbldepartment` where Id=$DepartmentId";
    $result=mysqli_query($conn,$q);
    if($result)
    {
        //echo "Deleted Successfully";
        header("location:display-add-department.php");
    }
    else
    {
        die(mysqli_error($conn));
    }
?>
