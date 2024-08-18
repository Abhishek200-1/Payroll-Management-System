<?php
    $s="localhost";
    $u="root";
    $p="";
    $db="payroll";
    $conn=mysqli_connect($s,$u,$p,$db);
            if(!$conn){
                die("Connection Failed:". mysqli_connect_error());
            }
            //echo "<script>alert('Connected Successfully');</script>";
?>