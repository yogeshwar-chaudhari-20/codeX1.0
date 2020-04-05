<?php 
session_start();
include "../includes/misc.inc";

if(isset($_POST['login_button']))
{
	$femail = $_POST['femail']; 
	$password = $_POST['password'];
	if(isset($_POST['admin_check']))
	{
		$select_admin = "SELECT * FROM admin WHERE femail = '$femail' AND password = '$password'";
		$result1 = mysqli_query($connect,$select_admin) or die("Sorry. Account not found");
		$count1 = mysqli_num_rows($result1);
		if($count1==1)
		{
			$row1 = mysqli_fetch_array($result1);
			//echo $row1["femail"];
			$_SESSION['id'] = $row1['id'];
			$_SESSION['fname'] = $row1['fname'];
			$_SESSION['femail'] = $row1['femail'];
			$_SESSION['phone1'] = $row1['phone1'];
			$_SESSION['admin'] = 1;
?>
			<html>
			<head>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
				<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
				<style>
				body
				{
				background-image: url(wall/.png);
				background-color: black;
				}
				</style>
			</head>
			<body>
			<script>
			//alert("ass hole World");
			
				swal({
						title: "Welcome Admin!",
						text: "Login Successful!",
						type: "success",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="../admin_panel/admin_page.php";
					}
					});
			</script>
			</body>
			</html>
<?php
			exit();
		}
		else
		{
?>
			<html>
			<head>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
				<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
				<style>
				body
				{
				background-image: url(wall/.png);
				background-color: black;
				}
				</style>
			</head>
			<body>
			<script>
			//alert("ass hole World");
			
				swal({
						title: "Error",
						text: "Login Unsuccessful!",
						type: "error",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="../index.html";
					}
					});
			</script>
			</body>
			</html>		
<?php
			exit();
		}
	}
	else if(!empty($femail) && !empty($password))
	{
		$select_user = "SELECT * FROM participant_info WHERE femail = '$femail' AND password = '$password'";
		$result = mysqli_query($connect,$select_user) or die("Sorry. Account not found");
		$count = mysqli_num_rows($result);
		
		if($count==1)
		{
			$row = mysqli_fetch_array($result);
			$_SESSION['id'] = $row['id'];
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['femail'] = $row['femail'];
			$_SESSION['phone1'] = $row['phone1'];
			$_SESSION['admin'] = 0;
	
			$_SESSION['score'] = $row['score'];
			$_SESSION['easy_solved'] = $row['easy_solved'];
			$_SESSION['inter_solved'] = $row['inter_solved'];
			$_SESSION['hard_solved'] = $row['hard_solved'];
/*			$_SESSION['current_easy_pointer'] = $row['current_easy_pointer'];
			$_SESSION['current_intermediate_pointer'] = $row['current_intermediate_pointer'];
			$_SESSION['current_hard_pointer'] = $row['current_hard_pointer']; */
			
			$_SESSION['current_easy_pointer'] = 1;
			$_SESSION['current_intermediate_pointer'] = 1;
			$_SESSION['current_hard_pointer'] = 1;
			
			$_SESSION['easy_solved'] = $row['easy_solved'];
			$_SESSION['inter_solved'] = $row['inter_solved'];
			$_SESSION['hard_solved'] = $row['hard_solved']; 

			$_SESSION['hint_left'] = 3;
			$_SESSION['ppa'] = 2;
			$_SESSION['pa'] = 2; 
			$_SESSION['ca'] = 2;
				
			$_SESSION['easy_out'] = 0;
			$_SESSION['intermediate_out'] = 0;
			$_SESSION['hard_out'] = 0;
?>
			<html>
			<head>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
				<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
				<style>
				body
				{
				background-image: url(wall/.png);
				background-color: black;
				}
				</style>
			</head>
			<body>
			<script>
			//alert("ass hole World");
			
				swal({
						title: "Success",
						text: "Login Successful!",
						type: "success",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="../exam_hall/exam_hall.php";
					}
					});
			</script>
			</body>
			</html>
<?php
			//header("Location:../exam_hall/exam_hall.php");
			exit();
		}
		else
		{
?>
			<html>
			<head>
				<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
				<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
				<style>
				body
				{
				background-image: url(wall/.png);
				background-color: black;
				}
				</style>
			</head>
			<body>
			<script>
			//alert("ass hole World");
			
				swal({
						title: "Error",
						text: "Login Unsuccessful!",
						type: "error",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="../index.html";
					}
					});
			</script>
			</body>
			</html>
			
<?php
			//header('Location:../index.html');
		}
	}
}
?>