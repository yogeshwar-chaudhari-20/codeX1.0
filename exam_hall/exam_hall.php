<?php 
session_start();
if(!isset($_SESSION['id']))
{
	header('../index.html?message=loginrequired');
	exit();
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Exam Hall - An Engaging Test Environment</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">

<script language='javascript' type='text/javascript'>
	var dl_return = setInterval(function(){dynamic_leaderboard(<?php echo $id;?>)},3000);
	
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
			ajaxRequest.open("GET", "update_leaderboard.php?id=<?php echo $_SESSION['id'];?>",true);
			ajaxRequest.send();
	} //end of dynamic_leaderboard()
	</script>	
	
<script>
	function enable_button1()
	{
		document.getElementById('button_1').disabled = false;
	}
</script>
<script>
		function get_next_question()
		{	
			var selected_option = '';
			
			if(document.getElementById('selected_option1').checked)
				selected_option = document.getElementById('selected_option1').value;
			if(document.getElementById('selected_option2').checked)
				selected_option = document.getElementById('selected_option2').value;
			if(document.getElementById('selected_option3').checked)
				selected_option = document.getElementById('selected_option3').value;
			if(document.getElementById('selected_option4').checked)
				selected_option = document.getElementById('selected_option4').value;
				
			var correct_option = document.getElementById('correct_option').value;
			
			var get_next_question_request;  // The variable that makes Ajax possible!
			try
			{
					// Opera 8.0+, Firefox, Safari
			get_next_question_request = new XMLHttpRequest();
			}catch (e){
				// Internet Explorer Browsers
				try{
					get_next_question_request = new ActiveXObject("Msxml2.XMLHTTP");
					}catch (e) {
         
						try{
						get_next_question_request = new ActiveXObject("Microsoft.XMLHTTP");
							}
						catch (e){
						// Something went wrong
							alert("Your browser broke!");
							return false;
								 }//end of catch blcok	
								}
					  }
   
				get_next_question_request.onreadystatechange = function(){
				if(get_next_question_request.readyState == 4)
				{
					var questionDisplay = document.getElementById('display_question_panel');
					questionDisplay.innerHTML = get_next_question_request.responseText;
					document.getElementById('hint_button').innerHTML = "<span class='badge badge-warning'></span> Hint"
				}
			}
			get_next_question_request.open("POST", "check_answer.php",true);
			get_next_question_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			get_next_question_request.send("selected_option="+selected_option+"&correct_option="+correct_option);
	} //end of get_question()
</script>

  </head>
  <body onload="dynamic_leaderboard(<?php echo $id;?>); countdown_timer(); get_first_question();">
    
 
  <nav class="navbar" >
		<div class="container topnav">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand">CodeX</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a id='clock'> </a>&nbsp;&nbsp;<span class=""><a id='logout_button' class='btn btn-md btn-outline-danger' href='../login_signup/logout.php'> Logout</a></span></li>
				<li></li>
			</ul>
		</div>
	</nav>
	
	<div class="container-fluid" style="background-image:url('./images/6.svg'); background-size:cover">
		<div class="row">
			<div class='col-md-9' id='display_question_panel'>

			</div>

			<div class='col-md-3'>
				<div id='leaderboard'>
				</div>
			</div>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>

		<script>
	var total_sec = 1800;
	var countdown_timer_return = setInterval(function(){ countdown_timer() }, 1000);
	function countdown_timer()
	{
		total_sec -= 1;
/*		if(total_sec<=300)
		{
			document.getElementById('button_1').style.display = 'none';
			document.getElementById('button_2').style.display = 'block';
		} */
		
		if(total_sec>=0)
		{
			hours = Math.floor(total_sec/ 3600);
			total_sec %= 3600;
			minutes = Math.floor(total_sec / 60);
			seconds = total_sec % 60;
			document.getElementById("clock").innerHTML = hours+" <sub>hrs</sub> : "+minutes+" <sub>mins</sub> : "+seconds+" <sub>secs</sub>";
		}
		else if(total_sec<=0)
		{
			window.location.href = "end.html";
		}
		if(total_sec==300)
			document.getElementById('logout_button').disabled = false;
	}
		</script>
		
	<script>
		function get_first_question()
		{
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
					var questionDisplay = document.getElementById('display_question_panel');
					questionDisplay.innerHTML = ajaxRequest.responseText;
					document.getElementById('hint_button').innerHTML = "<span class='badge badge-warning'>3 </span> Hint"
				}
			}
			ajaxRequest.open("POST", "get_first_question.php",true);
			ajaxRequest.send();
	
	} //end of get_first_question()

	</script>

<script>
var hint = 3;
		function get_hint()
		{	
			if(hint<=0)
			{
				document.getElementById('hint_button').disabled = true;
				document.getElementById('hint_area').innerHTML = "You have used all alotted hints. Best of luck !";
			}
			else
			{
			
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
					hint = hint - 1;
					var hint_area = document.getElementById('hint_area');
					document.getElementById('hint_button').disabled = true;
					document.getElementById('hint_button').innerHTML = "<span class='badge badge-warning'>"+hint+"</span> Hint";
					hint_area.innerHTML = ajaxRequest.responseText;
				}
			}
			ajaxRequest.open("GET", "get_hint.php",true);
			ajaxRequest.send();
			
			}
	} //end of get_hint()

	</script>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>