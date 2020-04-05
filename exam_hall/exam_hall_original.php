<?php
	$id = 1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Code_E_Salsa Exam Hall</title>

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
			ajaxRequest.open("GET", "update_leaderboard_original.php?id="+id,true);
			ajaxRequest.send();

	
	} //end of dynamic_leaderboard()
	</script>	
  </head>
  <body onload='dynamic_leaderboard(<?php echo $id;?>); countdown_timer();'>	
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href"#"> <STRONG>Code E Salsa</STRONG> </a>
				<STRONG></STRONG>
            <!-- Collect the nav links, forms, and other content for toggling -->
			<ul class="nav navbar-nav navbar-right">
				<li><a class='navbar-brand' align='right' id='clock'></a></li>
				<li><a href='../login_signup/logout.php'>Logout</a></li>
			</ul>
        </div>
        <!-- /.container -->
    </nav>
	<BR><BR><BR>
	<div class="container-fluid">
	<div class='col-md-9'>
			<div class='panel panel-success'>
				<div class='panel-heading'>
					<h3 align='left'> Question No. 1</h3>
				</div>
				
				<div class='panel-body'>
					<p><STRONG>int main()
					<BR>{<BR>cout<<"Hello World";<BR>return 0; <BR>}<BR><BR>What will be the output ?
					</STRONG></p><HR>
					<form action='check_answer.php' method='POST'>
						<input type='radio' name='selected_option' value='A' id="1"> Compile Time Error<BR>
						<input type='radio' name='selected_option' value='B' id="2"> Hello World<BR>
						<input type='radio' name='selected_option' value='C' id="3"> Runtime Error<BR>
						<input type='radio' name='selected_option' value='D' id="4"> I Don't Care<BR>
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
				window.location.href = "end.html";
			}
		}
	</script>
</body>
 
 
</html>
	
