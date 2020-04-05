<?php
session_start(); 
		require 'includes/misc.inc';
	?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>retrylogin@codeophile</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Code-E-Salsa</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				
				<ul class="nav navbar-nav navbar-right">
					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>	
	<BR><BR><BR><BR><BR>
	<h4 align='center'><?php echo "Please Login again to continue.";?></h4>
	<BR><BR>
	<div class='container'>
		<div class='row'>
			<div class='col-md-offset-3 col-md-6'>
				<div class='panel panel-warning'>
					<div class='panel-heading'>
						<h4>Log in to Code-E-Salsa</h4>
					</div>
					<div class='panel-body text-center'>
					<BR>
						<form action="login_signup/retrylogin_process.php" method='POST'>
						<div class='row text-center'>
							<div class='form-group'>
								<div class='col-md-offset-2 col-md-8'><input type='email' class='form-control' name='femail' placeholder='Email' required><BR></div>
							</div>
						</div>
		
						<div class='row text-center'>
							<div class='form-group'>
								<div class='col-md-offset-2 col-md-8'><input type='password' class='form-control' name='password' placeholder='Password' required><BR></div>
							</div>
						</div>
			
			<div class='row'>
				<div class='form-group'>
					<p align='center'><button class='btn btn-warning' name='login_button'><span class='glyphicon glyphicon-user'></span> L O G I N</button></p>
		
					<a href='index.html'>Sign in to Code-E-Salsa</a><br>
					</div>
				</div>
			</div>
		</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>