<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="../src/css/message.css" />
    <link rel="icon" type="image/png" href="../Employee/image/favicon.png">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <span class="big-circle"></span>
      <img src="../Employee/image/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Admin message portal</h3>
          

          <div class="info">
            <div class="information">
              <img src="../src/Images/svg/message.svg" class="icon" alt="" />
            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>
          <form method="post" autocomplete="off">
            <h3 class="title">Send Message to Department</h3>
            <label for="department">Select Department</label>
            <select name="department" id="department" required>
                <option value="1">HR</option>
                <option value="2">Finance</option>
                <option value="3">IT</option>
            </select>
            <div class="input-container textarea">
              <textarea name="message" id="message" rows="4" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>
    <script src="../src/Javascript/app.js"></script>
    <?php
        include("../Backend/Database/connection.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = mysqli_real_escape_string($conn, $_POST['message']);

            $query = "INSERT INTO department_messages (message) VALUES ( '$message')";
            if (mysqli_query($conn, $query)) {
                echo "Message sent successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
  </body>
</html>
