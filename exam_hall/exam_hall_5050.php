<?php
session_start(); 
	include '../includes/misc.inc';
	
	$temp = 0;
	$_SESSION['easy_out']=$_SESSION['intermediate_out']=$_SESSION['hard_out']=0;
	$id = $_SESSION['id'];	//user id
	$question_number = $_SESSION['question_number'];  //serial number of question to let the user know which question they are on.
	$current_difficulty = $_SESSION['current_difficulty'];
	$current_easy_pointer = $_SESSION['current_easy_pointer'];
	$current_intermediate_pointer = $_SESSION['current_intermediate_pointer'];
	$current_hard_pointer = $_SESSION['current_hard_pointer'];
	
l1 :
	if($_SESSION['current_difficulty']=='easy')
	{
		$get_question = "SELECT * FROM `easy` WHERE `id`=".$_SESSION['current_easy_pointer'];
	}
	else if ($_SESSION['current_difficulty']=='intermediate')
		{
			$get_question = "SELECT * FROM `intermediate` WHERE `id`=".$_SESSION['current_intermediate_pointer'];
		}
		else if($_SESSION['current_difficulty']=='hard')
			{
				$get_question = "SELECT * FROM `hard` WHERE `id`=".$_SESSION['current_hard_pointer'];
			}
			else
			{
				echo 'Problem with the difficulty selection';
			}
		
		$result = mysqli_query($connect,$get_question);
		$count = mysqli_num_rows($result);
		if($count==1)
		{
			$get_question_row = mysqli_fetch_array($result);
			extract($get_question_row);
		}
		else
		{
			if($_SESSION['easy_out']=$_SESSION['intermediate_out']=$_SESSION['hard_out']==1)
			{
				header('Location:end.html');
			}
			
			if($_SESSION['current_difficulty']=='easy')
			{
				$_SESSION['easy_out'] = 1;
				$_SESSION['current_difficulty'] = 'intermediate';
				goto l1;
				//goto l2;
			}
			else if($_SESSION['current_difficulty']=='intermediate')
				 {
					$_SESSION['intermediate_out'] = 1;
					if($temp==0)
					{
						$_SESSION['current_difficulty']='easy';
						$temp = 1;
						goto l1;
					}
					else if($temp==1)
					{
						$_SESSION['current_difficulty']='hard';
						$temp = 0;
						goto l1;
						//goto l3;						
					}
				 }
				 else if($_SESSION['current_difficulty']=='hard')
				 {
					$_SESSION['hard_out'] = 1;
					if($temp==0)
					{
						$_SESSION['current_difficulty']='easy';
						goto l1;
					}
					else if($temp==1)
					{
						$_SESSION['current_difficulty']='intermediate';
						goto l1;
						//goto l2;						
					}
				 }
		}
		
		$question = $get_question_row['question'];
		$option1 = $get_question_row['option1'];
		$option2 = $get_question_row['option2'];
		$option3 = $get_question_row['option3'];
		$option4 = $get_question_row['option4'];
		
		$wrong1 = $get_question_row['wrong1'];
		$wrong2 = $get_question_row['wrong2'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>exam_hall</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

<script language='javascript' type='text/javascript'>

	var dl_return = setInterval(function(){dynamic_leaderboard(<?php echo $id;?>)},5000);
	
		function dynamic_leaderboard(sent_id)
		{	
			var id = sent_id;
			var ajaxRequest;  // The variable that makes Ajax possible!
			try
			{
					// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
			}catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					}catch (e) {
         
						try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							}
						catch (e){
						// Something went wrong
							alert("Your browser broke!");
							return false;
								 }//end of catch blcok	
								}
					  }
   
				ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					var ajaxDisplay = document.getElementById('leaderboard');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
				}
			}
			ajaxRequest.open("GET", "update_leaderboard.php?id="+id,true);
			ajaxRequest.send();

	
	} //end of dynamic_leaderboard()
	
		function get_question(selected_option)
		{	
			var get_question_request;  // The variable that makes Ajax possible!
			try
			{
					// Opera 8.0+, Firefox, Safari
			get_question_request = new XMLHttpRequest();
			}catch (e){
				// Internet Explorer Browsers
				try{
					get_question_request = new ActiveXObject("Msxml2.XMLHTTP");
					}catch (e) {
         
						try{
						get_question_request = new ActiveXObject("Microsoft.XMLHTTP");
							}
						catch (e){
						// Something went wrong
							alert("Your browser broke!");
							return false;
								 }//end of catch blcok	
								}
					  }
   
				get_question_request.onreadystatechange = function(){
				if(get_question_request.readyState == 4)
				{
					var questionDisplay = document.getElementById('exam_box');
					questionDisplay.innerHTML = get_question_request.responseText;
				}
			}
			get_question_request.open("GET", "check_answer.php?selected_option="+selected_option,true);
			get_question_request.send();

	
	} //end of get_question()
	</script>	
  </head>
  <body onload='dynamic_leaderboard(<?php echo $id;?>); countdown_timer();'>
    <!--nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                <!--a class="navbar-brand" href"#"> <STRONG>Code E Salsa</STRONG> </a>
				<STRONG><a class='navbar-brand' align='right' id='clock'></a></STRONG-->
            <!-- Collect the nav links, forms, and other content for toggling -->
        <!/div>
        <!-- /.container -->
    <!/nav>
	
	
	<nav class="navbar navbar-inverse navbar-fixed-top topnav" role="navigation">
        <div class="container topnav text-center" align="center">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">     
				<br>
                <a class="navbar-brand topnav"><span class="glyphicon glyphicon-education"></span> Code - e - Salsa</a>
				<a class='navbar-brand topnav' id='clock'></a>
				<br>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="navbar">
                <ul class="nav navbar navbar-right">
					<li>
					<form action='../login_signup/logout.php' method='POST'>
						
							<div class = "col-md-offset col-md-12 col-pull-right">
								<div class="col-md-4">
									<br>
									<button class='btn btn-success' name='login_button' align="center"> Logout <span class="glyphicon glyphicon-log-out"></span></button> 
								</div>
							</div>
						
					</form>		
					</li>
                </ul>
				<br><br><br><br>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>	
	<BR><BR><BR>

	<div class="container-fluid">
	<br><br>
	<div class='col-md-9'>
			<div class='panel panel-success'>
				<div class='panel-heading'>
					<h3 align='left'> Question No. <?php echo $_SESSION['question_number']?></h3>
				</div>
				
				<div class='panel-body'>
					<p><STRONG><?php echo $question;?></STRONG></p><HR>
					<form action='check_answer.php' method='POST'>
						<input type='radio' name='selected_option' value='1' > <?php echo $option1;?><BR>
						<input type='radio' name='selected_option' value='2'> <?php echo $option2;?><BR>
						<input type='radio' name='selected_option' value='3'> <?php echo $option3;?><BR>
						<input type='radio' name='selected_option' value='4'> <?php echo $option4;?><BR>
						<BR>
						<input type='submit' name='next_question' class='btn btn-success' onclick='dynamic_leaderboard();'>
					</form>
				</div>
			</div>
	</div>  
	  
	<div class='col-md-3'>
		<div id='leaderboard'>
		</div>
	</div>

	</div>
	
	
	<div class="container-fluid">
	<form action='' method='POST'>
		<div class="col-md-12">
			<button name="fifty" id="fifty" class="btn btn-info" onclick="return disable();"> 50 - 50 </button>
		</div>
	</form>
 	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

	<script src="jquery-1.9.1.js"></script>


	<script>
	var x1 = '<?= $wrong1;?>';
	var x2 = '<?= $wrong2;?>';
    var f_f = $('#fifty');
	var radios = document.getElementsByName('selected_option');
	
	//for (var i = 0; i< radios.length;  i++){
	//}
	function disable() {
		radios[x1-1].disabled = true;
		radios[x2-1].disabled = true;
		f_f.attr('disabled', 'disabled');	
		return false;
	}
    </script>
	
	
	<script>
		var total_sec = 1800;
		var countdown_timer_return = setInterval(function(){ countdown_timer() }, 1000);
		function countdown_timer()
		{
			total_sec -= 1;
			if(total_sec>=0)
			{
				hours = Math.floor(total_sec/ 3600);
				total_sec %= 3600;
				minutes = Math.floor(total_sec / 60);
				seconds = total_sec % 60;
				document.getElementById("clock").innerHTML = hours+" <sub>hours</sub> : "+minutes+" <sub>minutes</sub> : "+seconds+" <sub>secs</sub> left";
			}
			else if(total_sec==0)
			{
				window.location('./end.html');
			}
		}
	</script>
</body>
 
 
</html>
	
