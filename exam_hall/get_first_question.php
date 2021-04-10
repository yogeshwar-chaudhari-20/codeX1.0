<?php
session_start(); 
	include '../includes/misc.inc';
	
	$_SESSION['easy_out']=$_SESSION['intermediate_out']=$_SESSION['hard_out']=0;
	$id = $_SESSION['id'];	//user id
	$question_number = $_SESSION['question_number'] = 1; //serial number of question to let the user know which question they are on.
	$current_difficulty = $_SESSION['current_difficulty'] = 'easy';
	$current_easy_pointer = $_SESSION['current_easy_pointer'];
	
	$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
	$result = mysqli_query($connect,$get_question) or die("<h3 align='center'>Can not load the question".mysqli_error($connect)."</h3>");
	$cursor = mysqli_fetch_array($result);
	extract($cursor);
	
		$display_string = "<div class='card shadow p-3 mb-5 bg-white rounded'>";
$display_string	.= "<div class='card-heading'>
				<h3 class='card-title' align='left'> Question No. ".$_SESSION['question_number']."</h3>
			</div>
			
			<div class='card-body'>
				<p><code>".nl2br($cursor['question'])."</code></p><HR>
			<form action='check_answer.php' method='POST' onsubmit='event.preventDefault(); dynamic_leaderboard(); get_next_question();'>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option1' value='A'>"." ".$cursor['option1']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option2' value='B'>"." ".$cursor['option2']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option3' value='C'>"." ".$cursor['option3']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option4' value='D'>"." ".$cursor['option4']."<BR>
				<input type='hidden' name='correct_option' id='correct_option' value='".$cursor['answer']."'><BR>
				<input name='next_question' style='width=300px;' id='button_1' type='submit' class='btn btn-primary' disabled>
			</form>
			
			<HR>
			
			<div class='row'>
				<div class='col-md-2'>
					<button id='hint_button' class='btn btn-outline-dark' onclick='get_hint()'></button>
				</div>
				
				<div class='col-md-9'>
					<p id='hint_area'></p>		
				</div>
			</div>
			
			</div>
	</div>";
	
	echo $display_string;
		
?>