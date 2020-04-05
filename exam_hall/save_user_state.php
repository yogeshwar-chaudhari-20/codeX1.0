<?php 
session_start();
require "includes/misc.ini";

$current_easy_pointer = $_SESSION['current_easy_pointer'];
$current_intermediate_pointer = $_SESSION['current_intermediate_pointer'];
$current_hard_pointer = $_SESSION['current_hard_pointer'];
$current_difficulty = $_SESSION['current_difficulty'];
$id = $_SESSION['id'];

mysqli_query($connect,"UPDATE user_state set current_easy_pointer =$current_easy_pointer, current_intermediate_pointer=$current_intermediate_pointer, current_hard_pointer = $current_hard_pointer current_difficulty = $current_difficulty WHERE id=$id") or die(mysqli_error($connect));
mysqli_close();
?>