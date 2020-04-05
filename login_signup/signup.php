<?php
session_start();
include "../includes/misc.inc";

if(isset($_POST['signup']))
{
	$fname = $_POST['fname'];
	$_SESSION['fname'] = $fname;
		
	if(empty($_POST['sname']))
		$sname = "";
	else 
	{
		$sname = $_POST['sname'];
		$_SESSION['sname'] = $sname;
	}
	
	$femail = $_POST['femail'];
	$_SESSION['femail'] = $femail;
	
	if(empty($_POST['semail']))
		$semail = "";
	else 
	{
		$semail = $_POST['semail'];
		$_SESSION['semail'] = $semail;
	}		
	
	$phone1 = $_POST['phone1'];
	$_SESSION['phone1'] = $phone1;
	
	if(empty($_POST['phone2']))
		$phone2 = "";
	else 
	{
		$phone2 = $_POST['phone2'];
		$_SESSION['phone2'] = $phone2;
	}
	
		

	if(!empty($_POST['femail']) && !empty($_POST['password']) && !empty($_POST['password2']))
	{
		$password = $_POST['password'];
		$repassword = $_POST['password2'];
		
		if($password==$repassword)
		{
			$add_user = "INSERT INTO participant_info (fname,sname,femail,semail,phone1,phone2,password) VALUES ('$fname','$sname','$femail','$semail','$phone1','$phone2','$password')";
			mysqli_query($connect,$add_user) or die(mysqli_error($connect)." hello");
	
				$_SESSION['fname'] = $fname;
				$_SESSION['femail'] = $femail;
				$_SESSION['phone1'] = $phone1;

/*			$get_sr = "SELECT `sr` FROM `login_table` WHERE `email`='$email' AND `password`='$password'";
			$get_sr_result = mysqli_query($connect,$get_sr) or die(mysqli_error($connect)." hey");
			$get_sr_row = mysqli_fetch_array($get_sr_result);
			extract($get_sr_row);
			
			$sr = $get_sr_row['sr'];

			$add_basic_info = "INSERT INTO `basic_info`(`sr`, `first`, `last`, `country_code`, `phone`, `lives_in`, `from`) VALUES ($sr,'$first','$last','','0','','')";
			mysqli_query($connect,$add_basic_info) or die(mysqli_error($connect)." basic");

				$_SESSION['uid'] = $sr;
				$_SESSION['first'] = $first;
				$_SESSION['last'] = $last;
				$_SESSION['phone'] = "NA";  */
			
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
						text: "Sign-Up Successful!",
						type: "success",
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
			//header("Location: ../index.html");
			exit();
		}
	}
}
?>