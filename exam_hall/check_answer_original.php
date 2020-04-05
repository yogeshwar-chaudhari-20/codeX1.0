<?php 
session_start();
include "../includes/misc.inc";

if(isset($_POST['next_question']))
{ 
	$_SESSION['current_question'] += 1; 
	$selected_option = $_POST['selected_option'];
	$current_difficulty = $_SESSION['$current_difficulty'];
	
	if($current_difficulty=='easy')
	{
		$get_answer = "SELECT answer FROM easy WHERE id =".$_SESSION['current_easy_pointer'];
		$_SESSION['current_easy_pointer'] += 1;  
	}
	else if($current_difficulty=='intermediate')
		{
			$get_answer = "SELECT 'answer' FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
			$_SESSION['current_intermediate_pointer'] += 1;
		}
	else if($current_difficulty=='hard')
		{
			$get_answer = "SELECT `answer` FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
			$_SESSION['current_hard_pointer'] += 1;
		}
		else
		{
			echo 'Problem with answer selection.';
		}
		
		$result = mysqli_query($connect,$get_answer);
		$get_answer_row = mysqli_fetch_array($result);
		
		extract($get_answer_row);	
		if($get_answer_row['answer']==$selected_option)
		{
			$_SESSION['ppa'] = $_SESSION['pa']; 
			$_SESSION['pa'] = $_SESSION['ca'];
			$_SESSION['ca'] = 1;
			
			if($_SESSION['current_difficulty']=='easy')
				$_SESSION['score'] += 1;
			else if($_SESSION['current_difficulty']=='intermediate')
				$_SESSION['score'] += 3;
			else if($_SESSION['current_difficulty']=='hard')
				$_SESSION['score'] += 5 ;
				
			$update_score = "UPDATE participant_info SET score = ".$_SESSION['score']." WHERE phone1 = ".$_SESSION['phone1'];
			mysqli_query($connect,$update_score) or die('Update score failed');
		}
		else 
		{
			$_SESSION['ppa'] = $_SESSION['pa']; 
			$_SESSION['pa'] = $_SESSION['ca'];
			$_SESSION['ca'] = 0;
		}
		
			if($_SESSION['ppa']=$_SESSION['pa']=$_SESSION['ca']==1)
			{
				if($_SESSION['current_difficulty'] =='easy')
				{
					$_SESSION['current_difficulty'] = 'intermediate';
				}
				else if($_SESSION['current_difficulty'] =='intermediate')
					{
						$_SESSION['current_difficulty'] == 'hard';
					}
				else if($_SESSION['current_difficulty'] =='hard')
					 {
						$_SESSION['score'] += 5;
					 }
			}
			else if($_SESSION['pa']=$_SESSION['ca']==0)
			{
				if($_SESSION['current_difficulty'] =='hard')
					$_SESSION['current_difficulty'] = 'intermediate';
				else if($_SESSION['current_difficulty'] =='intermediate')
					$_SESSION['current_difficulty'] == 'easy';
			}
	
			header('Location:exam_hall.php');
}
else
{
	header("Location:exam_hall.php");
}
?>