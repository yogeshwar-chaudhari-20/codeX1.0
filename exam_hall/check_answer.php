<?php 
session_start();
include "../includes/misc.inc";
	$get_question = "";
	$easy_questions = 40;		      //number of questions in easy table
	$intermediate_questions = 40;
	$hard_questions = 40;
	$selected_option = $_POST['selected_option'];	
	$correct_option = $_POST['correct_option'];
	
	$current_difficulty = $_SESSION['current_difficulty'];
		
	if($correct_option==$selected_option)	//if answer is right
	{
		switch($current_difficulty)         //check current difficulty for updating score
		{
			case 'easy' :
			{
				$_SESSION['score'] += 1;
				$_SESSION['easy_solved'] += 1; 
				$_SESSION['current_easy_pointer'] += 1;
				$update_score = "UPDATE `participant_info` SET `score`=".$_SESSION['score']." ,`easy_solved`=".$_SESSION['easy_solved']."  WHERE `id`=".$_SESSION['id'];
			}
			break;
		
			case 'intermediate' :
			{
				$_SESSION['score'] += 3;
				$_SESSION['inter_solved'] += 1; 
				$_SESSION['current_intermediate_pointer'] += 1;
				$update_score = "UPDATE `participant_info` SET `score`=".$_SESSION['score']." ,`inter_solved`=".$_SESSION['inter_solved']." WHERE `id`=".$_SESSION['id'];
			}
			break;
		
			case 'hard' :
			{
				$_SESSION['score'] += 9;
				$_SESSION['hard_solved'] += 1; 
				$_SESSION['current_hard_pointer'] += 1;
				$update_score = "UPDATE `participant_info` SET `score`=".$_SESSION['score']." ,`hard_solved`=".$_SESSION['hard_solved']." WHERE `id`=".$_SESSION['id'];
			}
			break;

			default :
			{
				echo 'Problem with answer selection.';
			}
		} //end of switch for answer of current question selection		
	
			mysqli_query($connect,$update_score) or die('Update score failed');
			
			//right answer is indicated by 1 while wrong answer is indicated by 0;
			
			$_SESSION['ppa'] = $_SESSION['pa'];			//ppa - previous of previous answer 
			$_SESSION['pa'] = $_SESSION['ca'];			//previous answer
			$_SESSION['ca'] = 1;						//current answer

	}
	else	//if answer of current question is wrong (not right)
	{
		$_SESSION['ppa'] = $_SESSION['pa']; 
		$_SESSION['pa'] = $_SESSION['ca'];
		$_SESSION['ca'] = 0;
		
		switch($current_difficulty)
		{
			case 'easy' :
			{
				$_SESSION['current_easy_pointer'] += 1;
			}
			break;
		
			case 'intermediate' :
			{
				$_SESSION['current_intermediate_pointer'] += 1;	
			}
			break;
		
			case 'hard' :
			{
				$_SESSION['current_hard_pointer'] += 1;
			}
			break;
		} // If answer is wrong.	
	}
	
/*
	following section checks which table has reached to it's end. 
	'easy out' denotes that easy table is out of questions and likewise
*/
if($easy_questions==$_SESSION['current_easy_pointer'])
{
	$_SESSION['easy_out'] = 1;
}
if($intermediate_questions==$_SESSION['current_intermediate_pointer'])
{
	$_SESSION['intermediate_out'] = 1;
}
if($hard_questions==$_SESSION['current_hard_pointer'])
{
	$_SESSION['hard_out'] = 1;
}

		/*
			If user solves 3 questions right in a row then do following. i.e. ppa == pa == ca == 1
		*/
		if($_SESSION['ppa']==1 && $_SESSION['pa']==1 && $_SESSION['ca']==1)
		{
			//reset history of answers
			$_SESSION['ppa'] = $_SESSION['pa'] = $_SESSION['ca'] = 2;
			
			/*
				Following switch case finds the current difficulty level and then jumps to next immediate higher difficulty level and forms a query to select question with newly determined difficulty.
				While doing so it also has to check if table it is going to refer is runnig out of questions ? 
				if easy -> intermediate
				if intermediate -> hard
				if hard -> hard
			*/
			switch($current_difficulty)
			{
				case 'easy' :
				{
					$_SESSION['current_difficulty'] = "intermediate";
					if($_SESSION['intermediate_out']==0)
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					else if($_SESSION['hard_out']==0)
					{
						$_SESSION['current_difficulty'] = 'hard';
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					}
						else if($_SESSION['easy_out']==0)
						{
							$_SESSION['current_difficulty'] = 'easy';
							$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
						}
				}
				break;
				case 'intermediate' :
				{
					$_SESSION['current_difficulty'] = "hard";
					if($_SESSION['hard_out']==0)
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					else if($_SESSION['easy_out']==0)
					{
						$_SESSION['current_difficulty'] = 'easy';
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					}
					else if($_SESSION['intermediate_out']==0)
					{
						$_SESSION['current_difficulty'] = 'intermediate';
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					}
				}
				break;
					 
				default :
				{
					$_SESSION['current_difficulty'] = "hard";
					if($_SESSION['hard_out']==0)
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					else if($_SESSION['easy_out']==0)
					{
						$_SESSION['current_difficulty'] = 'easy';
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					}
					else if($_SESSION['intermediate_out']==0)
						{
							$_SESSION['current_difficulty'] = 'intermediate';
							$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
						}
				}
			}
		}
		else if($_SESSION['pa']==0 && $_SESSION['ca']==0)
			{
				/*
					This section deals with steps to be table when user gives 2 wrong answers in row.
					i.e pa == ca ==0 
					then reset history. 
				*/
				$_SESSION['ppa'] = $_SESSION['pa'] = $_SESSION['ca'] = 2;
			switch($current_difficulty)
			{
				case 'intermediate' :
				{
					$_SESSION['current_difficulty'] = 'easy';
					if($_SESSION['easy_out']==0)
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					else if($_SESSION['intermediate_out']==0)
					{
						$_SESSION['current_difficulty'] = 'intermediate';
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					}
					else if($_SESSION['hard_out']==0)
					{
						$_SESSION['current_difficulty'] = 'hard';
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					}
				}
				break;
		
				case 'hard' :
				{
					$_SESSION['current_difficulty'] = 'intermediate';
					if($_SESSION['intermediate_out']==0)
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
						else if($_SESSION['easy_out']==0)
						{	
							$_SESSION['current_difficulty'] = 'easy';
							$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
						}
							else if($_SESSION['hard_out']==0)
							{
								$_SESSION['current_difficulty'] = 'hard';
								$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
							}
				}
				break;
					 
				case 'easy' :
				{
					$_SESSION['current_difficulty'] = 'easy';
					if($_SESSION['easy_out']==0)
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					else if($_SESSION['intermediate_out']==0)
					{
						$_SESSION['current_difficulty'] = 'intermediate';
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					}
					else if($_SESSION['hard_out']==0)
					{
						$_SESSION['current_difficulty'] = 'hard';
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					}
				}
				break;
			}// end of switch for lowering difficulty
			
			}// end of if of lowering difficulty
			else
			{
				//default procedure
				switch($current_difficulty)
				{
				case 'easy' :
				{
					if($_SESSION['easy_out']==0)
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					else if($_SESSION['intermediate_out']==0)
					{
						$_SESSION['current_difficulty'] = 'intermediate';
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					}
					else if($_SESSION['hard_out']==0)
					{
						$_SESSION['current_difficulty'] = 'hard';
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					}
				}
				break;
				case 'intermediate' :
				{
					if($_SESSION['intermediate_out']==0)
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					else if($_SESSION['hard_out']==0)
					{
						$_SESSION['current_difficulty'] = 'hard';
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					}
						else if($_SESSION['easy_out']==0)
						{
							$_SESSION['current_difficulty'] = 'easy';
							$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
						}
				}
				break;
					 
				case 'hard' :
				{
					if($_SESSION['hard_out']==0)
						$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
					else if($_SESSION['easy_out']==0)
					{
						$_SESSION['current_difficulty'] = 'easy';
						$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
					}
					else if($_SESSION['intermediate_out']==0)
					{
						$_SESSION['current_difficulty'] = 'intermediate';
						$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
					}
				}
				break;
				}
			}

			//serial number of question to let the user know which question they are on.
	$_SESSION['question_number'] += 1;

if($get_question!="")
{	
	$table_color = '';
	$result = mysqli_query($connect,$get_question) or die(mysqli_error($connect));
	$count = mysqli_num_rows($result);
	if($count==1)
	{
			$cursor = mysqli_fetch_array($result);
			switch($current_difficulty)
			{
				case 'easy' : 
				{
					$table_color = 'success';
				}
				break;
				
				case 'intermediate' : 
				{
					$table_color = 'warning';
				}
				break;
				
				case 'hard' : 
				{
					$table_color = 'danger';
				}
				break;
				default :
				{
					$table_color = 'primary';
				}
			}
		$display_string = "<div class='panel panel-".$table_color."'>";
		$display_string	.= "<div class='panel-heading'>
				<h3 align='left'> Question No. ".$_SESSION['question_number']."</h3>
			</div>
			
			<div class='panel-body'>
				<p><STRONG>".nl2br($cursor['question'])."</STRONG></p><HR>
			<form action='check_answer.php' method='POST' onsubmit='event.preventDefault(); dynamic_leaderboard(); get_next_question();'>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option1' value='A'>"." ".$cursor['option1']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option2' value='B'>"." ".$cursor['option2']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option3' value='C'>"." ".$cursor['option3']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option4' value='D'>"." ".$cursor['option4']."<BR>
				<input type='hidden' id='correct_option' value='".$cursor['answer']."'>
				<BR>
			<div class='row'>
				<div class='col-md-2'>
					<input name='next_question' style='width=300px;' type='submit' id='button_1' class='btn btn-primary' style='display=block' disabled>
				</div>
			</div>
			
			</form>		
			
			<HR>
			<div class='row'>
				<div class='col-md-2'>
					<button id='hint_button' class='btn btn-default' onclick='get_hint()'></button>
				</div>
				
				<div class='col-md-9'>
					<p id='hint_area'></p>		
				</div>
			</div>
			
			</div>
	</div>";

		echo $display_string;
		echo "<div class='container'><div class='row'><div class='panel panel-default'><div class='panel-body' style='border-style:solid;border-color:#337ab7;border-width:1px;'><p>Previous Of Previous Answer = ".$_SESSION['ppa']." / Previous Answer = ".$_SESSION['pa']." / Current Answer = ".$_SESSION['ca']." ".$_SESSION['current_difficulty']."</p></div></div></div></div>";
	}
}
else
{
	echo $_SESSION['ppa']." ".$_SESSION['pa']." ".$_SESSION['ca']." ".$_SESSION['current_difficulty'].$count."      <BR>".$_SESSION['easy_out']." ".$_SESSION['intermediate_out']." ".$_SESSION['hard_out'];
		
	if($_SESSION['easy_out']==1 && $_SESSION['intermediate_out']==1 && $_SESSION['hard_out']==1)
	{
		header('Location:end.php?para=1');
	}
}
?>