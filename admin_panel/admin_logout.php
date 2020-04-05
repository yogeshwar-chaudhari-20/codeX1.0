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
			text: "",
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
						text: "You have Logged Out Successfully!",
						type: "success",
						confirmButtonText: "OK",						
						timer: 4000,
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							window.location.href="admin_logout2.php";
					}
					});
			}else {
				window.history.back();
		}
		});
	</script>
	</body>
</html>