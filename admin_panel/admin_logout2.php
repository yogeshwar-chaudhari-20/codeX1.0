<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['fname']);
unset($_SESSION['femail']);
unset($_SESSION['phone1']);
session_destroy();
header("Location: ../index.html");
exit;
?>