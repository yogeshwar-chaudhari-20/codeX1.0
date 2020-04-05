<?php
$hostname = 'localhost';
$username = "root";
$password = ''; //RvavLQD9jCp7AnMB
$database_name = 'code_e_salsa';

$connect = mysqli_connect($hostname,$username,$password,$database_name) or die('Error Connecting to server at this moment.');

function clear_text($data)
{
	$data = stripslashes($data);
	return $data;	
}
?>