<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Emp Id</th>
                      <th scope="col">First Name</th>
                      <?php
                    // Generate day headers for the selected month
                    $month = 8; // August
                    $year = 2024;
                    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    for ($day = 1; $day <= $days_in_month; $day++) {
                        echo "<th>$day</th>";
                    }
                    ?>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <?php 
                        for ($day = 1; $day <= $days_in_month; $day++) {
                          echo "<td><input type='checkbox' value='Present'></td>";
                      }
                      ?>
                    </tr>
                  </tbody>
            </table>
        </div>
    </div>
</body>
</html>