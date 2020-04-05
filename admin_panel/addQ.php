<?php
session_start();
include '../includes/misc.inc';

//if(isset($_SESSION['femail'])  AND $_SESSION['admin']==1)
//{
  //die( "Login required." );
	if(isset($_POST['insert_que']))
	{
		if(!empty($_POST['question']))
		{
			$question = $_POST['question'];
			$_SESSION['question'] = $question;
		}
		
		if(!empty($_POST['option1']))
		{
			$option1 = $_POST['option1'];
			$_SESSION['option1'] = $option1;
		}
		
		if(!empty($_POST['option2']))
		{
			$option2 = $_POST['option2'];
			$_SESSION['option2'] = $option2;
		}
		if(!empty($_POST['option3']))
		{
			$option3 = $_POST['option3'];
			$_SESSION['option3'] = $option3;
		}
		if(!empty($_POST['option4']))
		{
			$option4 = $_POST['option4'];
			$_SESSION['option4'] = $option4;
		}
		if(!empty($_POST['answer']))
		{
			$answer = $_POST['answer'];
			$_SESSION['answer'] = $answer;
		}
		
		if(!empty($_POST['wrong1']))
		{
			$wrong1 = $_POST['wrong1'];
			$_SESSION['wrong1'] = $wrong1;
		}
		
		if(!empty($_POST['wrong2']))
		{
			$wrong2 = $_POST['wrong2'];
			$_SESSION['wrong2'] = $wrong2;
		}
			
		if($_POST['qtype'] == 'easy')
		{
			$add_que = "INSERT INTO easy (question,option1,option2,option3,option4,answer,wrong1,wrong2) VALUES ('$question','$option1','$option2','$option3','$option4','$answer','$wrong1','$wrong2')";
			mysqli_query($connect,$add_que) or die(mysqli_error($connect).". Please check if table exists in database!");
		}
		else if($_POST['qtype'] == 'intermediate')
		{
			$add_que = "INSERT INTO intermediate (question,option1,option2,option3,option4,answer,wrong1,wrong2) VALUES ('$question','$option1','$option2','$option3','$option4','$answer','$wrong1','$wrong2')";
			mysqli_query($connect,$add_que) or die(mysqli_error($connect).". Please check if table exists in database!");
		}
		else if($_POST['qtype'] == 'difficult')
		{
			$add_que = "INSERT INTO hard (question,option1,option2,option3,option4,answer,wrong1,wrong2) VALUES ('$question','$option1','$option2','$option3','$option4','$answer','$wrong1','$wrong2')";
			mysqli_query($connect,$add_que) or die(mysqli_error($connect).". Please check if table exists in database!");
		}	
		header("Location: admin_page.php");
	}
/*}
else
{
?>
<h2 style="background-color:; color:red"> Login Required. </h2>
<?php
}*/
?>