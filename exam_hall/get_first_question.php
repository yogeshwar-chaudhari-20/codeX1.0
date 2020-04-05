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
	
		$display_string = "<div class='panel panel-primary'>";
$display_string	.= "<div class='panel-heading'>
				<h3 align='left'> Question No. ".$_SESSION['question_number']."</h3>
			</div>
			
			<div class='panel-body'>
				<p><STRONG>".nl2br($cursor['question'])."</STRONG></p<HR>
			<form action='check_answer.php' method='POST' onsubmit='event.preventDefault(); dynamic_leaderboard(); get_next_question();'>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option1' value='A'>"." ".$cursor['option1']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option2' value='B'>"." ".$cursor['option2']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option3' value='C'>"." ".$cursor['option3']."<BR>
				<input type='radio' onchange='enable_button1();' name='option' id='selected_option4' value='D'>"." ".$cursor['option4']."<BR>
				<input type='hidden' name='correct_option' id='correct_option' value='".$cursor['answer']."'><BR>
				<BR>
				<input name='next_question' style='width=300px;' id='button_1' type='submit' class='btn btn-primary' disabled>
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
		
?>