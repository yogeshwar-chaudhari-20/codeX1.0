<?php 
session_start();
include "../includes/misc.inc";

if(isset($_POST['login_button']))
{
	$femail = $_POST['femail']; 
	$password = $_POST['password'];
	
	if(!empty($femail) && !empty($password))
	{
		// do not judge us from the login script. We don't need much security for this use.
		$select_user = "SELECT * FROM participant_info WHERE femail = '$femail' AND password = '$password'";
		$result = mysqli_query($connect,$select_user) or die("Sorry. Account not found");
		$count = mysqli_num_rows($result);
		
		if($count==1)
		{
			$row = mysqli_fetch_array($result);
			$_SESSION['id'] = $row['id'];
			
			$_SESSION['current_easy_pointer'] = $row['current_easy_pointer'];
			$_SESSION['current_intermediate_pointer'] = $row['current_intermediate_pointer'];
			$_SESSION['current_hard_pointer'] = $row['current_hard_pointer'];		
			
			$_SESSION['easy_solved'] = $row['easy_solved'];
			$_SESSION['inter_solved'] = $row['inter_solved'];
			$_SESSION['hard_solved'] = $row['hard_solved'];
			
			$_SESSION['ppa'] = 2;
			$_SESSION['pa'] = 2; 
			$_SESSION['ca'] = 2;
			
			$_SESSION['score'] = $row['score'];
			
			mysqli_close($connect);
			header("Location:../exam_hall/exam_hall.php");
			exit();
		}
	}
}
else
{
	header("Location:../retrylogin.php");
	exit();
}
?>