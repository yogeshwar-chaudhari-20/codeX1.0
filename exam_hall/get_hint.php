<?php
require "../includes/misc.inc";
session_start();
 
if(isset($_SESSION['id']))
{
		switch($_SESSION['current_difficulty'])
		{
			case 'easy' :
			{
				$select_hint = "SELECT hint from `easy` WHERE id=".$_SESSION['current_easy_pointer'];
			}
			break;
		
			case 'intermediate' :
			{
				$select_hint = "SELECT hint from `intermediate` WHERE id=".$_SESSION['current_intermediate_pointer'];
			}
			break;
		
			case 'hard' :
			{
				$select_hint = "SELECT hint from `hard` WHERE id=".$_SESSION['current_hard_pointer'];
			}
			break;

			default :
			{
				echo 'Problem with hint selection.';
			}
		}
		
		$result = mysqli_query($connect,$select_hint);
		$row = mysqli_fetch_array($result) or die(mysqli_error($connect));
		$_SESSION['hint_left'] -= 1;
		echo $row['hint'];
		mysqli_close($connect);
}
else
{
	echo "Problem in loading the hint";
}
?>