<?php
    $FisrtDayOfMonth = date("1-m-Y");
    $totalDaysInMonth = date("t", strtotime($FisrtDayOfMonth));
    
    $totalNumbersOfStudents = 5;
?>

<H1>Smart Attendance Management System</H1>
<h3>Attendance Month : <u><font color="red"><?php echo strtoupper(date("F")); ?></u></h3>

<table border="1" cellspacing="0">
    <?php
        for($i=1; $i<=$totalNumbersOfStudents + 2; $i++)
        {
            if($i == 1)
            { 
                echo "<tr>";
                echo "<td rowspan='2'>names</td>";
                    for($j=1; $j<=$totalDaysInMonth; $j++)
                    {
                        echo "<td>$j</td>";
                    }
                echo "</tr>";
            }
            else if($i == 2)
            { 
                echo "<tr>";
                    for($j=0; $j<$totalDaysInMonth; $j++)
                    {
                        echo "<td>". date("D", strtotime("+$j days", strtotime($FisrtDayOfMonth))) ."</td>";
                    }
                echo "</tr>";
            }
            else
            { 
                echo "<tr>";
                echo "<td>ABC</td>";
                    for($j=0; $j<$totalDaysInMonth; $j++)
                    {
                        echo "<td></td>";
                    }
                echo "</tr>";
            }
        }
    ?>
</table>