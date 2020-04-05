<?php
/*	unset($_SESSION['score']);
	unset($_SESSION['current_easy_pointer']);
	unset($_SESSION['current_intermediate_pointer']);
	unset($_SESSION['current-hard_pointer']);
	unset($_SESSION['easy_solved']);
	unset($_SESSION['inter_solved']);
	unset($_SESSION['hard_solved']);
	unset($_SESSION['femail']);
	unset($_SESSION['fname']);
	unset($_SESSION['phone1']);
	unset($_SESSION['id']); */
	
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
			title: "Are you sure you want to Logout?",
			text: "This will Submit Your Test!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Logout!",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				swal({
						title: "Success",
						text: "The Test has been Submitted!",
						type: "success",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="logout2.php";
					}
					});
			}else {
				window.history.back();
		}
		});
	</script>
	</body>
</html>