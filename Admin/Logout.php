<?php
session_start();

echo $_SESSION['AdminId'];

unset($_SESSION['AdminId']);
header("Location: ../Dist/indexx.php");
