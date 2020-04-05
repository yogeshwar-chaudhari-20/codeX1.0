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

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
	<style>
	.nav_a
	{
		position : relative;
		top : 8px;
	}
	body
	{
		font-family: 'Montserrat', sans-serif;
	}
	p
	{
		font-size : 18px;
		line-height : 150%;
	}
	
	.btn-primary
	{
		background-color : white;
		color : #337ab7;
		border-color : #337ab7;
		border-width : 2px;
	}
	
	.btn-primary:hover
	{
		background-color : #337ab7;
		color: white;
		border-color:#337ab7;
		transition:all 0.3s ease-in-out;
		-moz-transition:all 0.3s ease-in-out;
		-webkit-transition:all 0.3s ease-in-out;
	}
	.navbar
	{
		background-color : #262626;
		border : none;
	}
	
	
	</style>
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
					document.getElementById('hint_button').innerHTML = "<span class='badge'></span> Hint"
				}
			}
			get_next_question_request.open("POST", "check_answer.php",true);
			get_next_question_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			get_next_question_request.send("selected_option="+selected_option+"&correct_option="+correct_option);
	} //end of get_question()
</script>
<style>
	.navbar-brand
	{
		position : absolute;
		top : 3px;
		left : 40px;
		font-size : 25px;
	}
	
	.navbar
	{	
		background-color: #e6e6e6;
	}
	
</style>
  </head>
  <body onload="dynamic_leaderboard(<?php echo $id;?>); countdown_timer(); get_first_question();">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href"#" style="color:"> <STRONG> CodeX</STRONG> </a>
            <!-- Collect the nav links, forms, and other content for toggling -->
			<ul class="nav navbar-nav navbar-right">
				<li><a class='nav' align='right' id='clock' style="color:black;"></a></li>
				<a id='logout_button' class='nav_a btn btn-danger btn-sm' href='../login_signup/logout.php'><span class='glyphicon glyphicon-log-out'></span></a>
			</ul>
        </div>
        <!-- /.container -->
    </nav>
 <BR><BR><BR>

<div class='col-md-9' id='display_question_panel'>

</div>
<div class='col-md-3'>
	<div id='leaderboard'>
	</div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

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
					document.getElementById('hint_button').innerHTML = "<span class='badge'>3 </span> Hint"
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
					document.getElementById('hint_button').innerHTML = "<span class='badge'>"+hint+"</span> Hint";
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
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

<!-- 50 - 50 Code >
<!--div class="container-fluid">
	<form action='' method='POST'>
		<div class="col-md-12">
			<button name="fifty" id="fifty" class="btn btn-info" onclick="return disable();"> 50 - 50 </button>
		</div>
	</form>
</div>

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
    </script-->