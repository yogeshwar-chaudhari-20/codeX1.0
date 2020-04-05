<!DOCTYPE html>
<?php
session_start();
//if(isset($_SESSION['femail']) AND $_SESSION['admin']==1)
//{
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="w3.css">
	<script src="sweetalert-master/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TechTonic</title>

	<script language='javascript' type='text/javascript'>

		var dl_return = setInterval(function(){admin_dynamic_leaderboard()},2000);
		
			function admin_dynamic_leaderboard()
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
						var ajaxDisplay = document.getElementById('leaderboard');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.open("GET", "update_leaderboard.php",true);
				ajaxRequest.send();

		
		} //end of dynamic_leaderboard()
	</script>
	
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

	<link href="css/landing-page.css" rel="stylesheet">

	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	body
	{
	background-image: url(wall/.png);
	background-color: white;
	background-size: 100%;
	#18BC9C;
	
	}	
	a.one:link, a.one:visited {
		background-color: #f44336;
		color: white;
		padding: 14px 25px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
	}
	a.one:hover, a.one:active {
		background-color: gray;
	}
	</style>
</head>

<body id="page-top" class="index" onload='admin_dynamic_leaderboard();'>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand topnav" href="#page-top"><span class="glyphicon glyphicon-education"></span> Code - e - Salsa</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="padding:10px">
                    <li>
						<form action='admin_logout.php' method='POST'>
							<button class='btn btn-success btn-sm col-md-offset-2' name='login' align="center"> Logout <span class="glyphicon glyphicon-log-out"></span></button> 
						</form>		
					</li>
                </ul>
				<br><br>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<div class="container ">
		<div class="text-center col-md-2">
			<div class="container1 col-md-12">
				<!--ul>
				<li><a class="one" href="#" type="submit" class="active" onClick="leaderboard();" id="b1">Leaderboard</a></li>
				<br><br>
				<li><a class="one" href="#" onClick="addQ();" id="b2">Add Question/s</a></li>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</ul-->
				<!--ul>
				<li><button type="submit" class="btn btn-default" onClick="leaderboard();" id="b1">Leaderboard</button></li>
				<br><br>
				<li><button type="submit" class="btn btn-default active" onClick="addQ();" id="b2">Add Question/s</button></li>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</ul-->
				<ul class="nav nav-pills nav-stacked col-md-12">
					<li class="placeholder" id="gotclass" onclick="navigationSwitch123(event); leaderboard();"><a href="#">Leaderboard</a></li>
					<br>
					<li class="active" id="noclass1" onclick="navigationSwitch123(event); addQ();"><a href="#">Add Question</a></li>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</ul>
			</div>			
		</div>
		
		<div style="display:none; background-color:lightgray;" class="col-md-9 text-center" id="leaderboard">
		
		</div>

		<form role="form" action='addQ.php' method='POST' class="form-horizontal">
			<div style="display:block; background-color:lightgray;" class="col-md-9 text-center checkbox-inline jumbotron" id="addQ">	
				<div class="form-group text-center">
					<label for="name"><h2>Q U E S T I O N - F O R M</h2></label>
				</div>
				
				<div class="form-group">					
					<input type="radio" name="qtype" value="easy" checked> Easy
					<input type="radio" name="qtype" value="intermediate"> Intermediate
					<input type="radio" name="qtype" value="difficult"> Difficult
				</div>
				<br>
				
				<div class="form-group text-left">
					<label for="name">Question</label>
					<textarea class="form-control" style="display:block;" rows="5" name="question" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Option1</label>
					<textarea class="form-control" rows="1" name="option1" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Option2</label>
					<textarea class="form-control" rows="1" name="option2" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Option3</label>
					<textarea class="form-control" rows="1" name="option3" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Option4</label>
					<textarea class="form-control" rows="1" name="option4" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name" style="color:red;" required>Answer</label>
					<input type="text" class="form-control" name="answer" id="answer" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Wrong Option1</label>
					<input type="text" class="form-control" name="wrong1" id="wrong1" required></textarea>
				</div>
				
				<div class="form-group text-left">
					<label for="name">Wrong Option2</label>
					<input type="text" class="form-control" name="wrong2" id="wrong2" required></textarea>
				</div>

				<p id="p" style="color:red;"> </p>

				<br>
				<div class="form-group"> <!--onclick="return valid_Input()" -->
					<button type="submit" class="btn btn-md btn-success" name="insert_que">Insert</button>
				</div>
				
			</div>
		</form>
	</div>	
	
	<div class="navbar">
			<br>
			<p class="copyright text-muted small text-center">Code - e - Salsa @ TechTonic SKNCOE 2017</p>
	</div>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	
	<script src="jquery-1.9.1.js"></script>
	<script>
		//$("#hello").click(hello);
		
		function navigationSwitch123(e){
		resetClasses();
		document.getElementById(e.currentTarget.id).className = "active gotclass";
		}

		function resetClasses(){
		document.getElementById("gotclass").className = "placeholder";
		document.getElementById("noclass1").className = "placeholder";
		}
		
		function valid_Input()
		{
			var ans = document.getElementById('answer').value;
			var wrg1 = document.getElementById('wrong1').value;
			var wrg2 = document.getElementById('wrong2').value;
		
			document.getElementById("p").innerHTML = "";	
			
			if (isNaN(ans) || isNaN(wrg1) || isNaN(wrg2) || ans>4 || wrg1>4 || wrg2>4 || ans<=0 || wrg1<=0 || wrg2<=0)
			{
				var para = document.createElement("P");	
				text = document.createTextNode("Empty/Invalid Option Values Entered.");
				para.appendChild(text);
				document.getElementById("p").appendChild(para);
				return false;
			}
			if((ans==wrg1) || (wrg1==wrg2) || (ans==wrg2))
			{
				var para = document.createElement("P");	
				text = document.createTextNode("Same Option Values Entered.");
				para.appendChild(text);
				document.getElementById("p").appendChild(para);
				return false;
			}
			return true;
		}		
		
		function myFunction() {
			var x = document.getElementById("b2");
			x.style.fontSize = "25px"; 
			x.style.color = "red"; 
			x.style.hover = "green";
		}		
		
		function leaderboard()
		{
			document.getElementById('addQ').style.display = 'none';
			document.getElementById('leaderboard').style.display = 'block'; 
			admin_dynamic_leaderboard();			
		}
		
		function addQ()
		{
			document.getElementById('leaderboard').style.display = 'none'; 
			document.getElementById('addQ').style.display = "block";
		}		
	</script>
</body>
</html>

<?php
//}
//else
//{
//	//die( "Login required." );
?>
<h2 style="background-color:; color:red"> Login Required. </h2>
<?php
//}
?>