<?php
session_start();
	unset($_SESSION['score']);
	unset($_SESSION['current_easy_pointer']);
	unset($_SESSION['current_intermediate_pointer']);
	unset($_SESSION['current-hard_pointer']);
	unset($_SESSION['easy_solved']);
	unset($_SESSION['inter_solved']);
	unset($_SESSION['hard_solved']);
	unset($_SESSION['femail']);
	unset($_SESSION['fname']);
	unset($_SESSION['phone1']);
	unset($_SESSION['id']);
session_destroy();
header("Location: ../index.html");
exit;
?>