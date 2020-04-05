<?php
$_SESSION['id'] = 1;
	//$output = shell_exec('C:\mingw\bin\g++ D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.cpp -O3 -o D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.cpp');
passthru('C:\mingw\bin\g++ D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.cpp -O3 -o D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.cpp');
	print_r($output);
	echo $outpu;
	//echo $return_status;
//	exec('C:\mingw\bin\g++ D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.cpp -O3 -o D:\xampp\htdocs\code_e_salsa\bigdata\\'.$_SESSION['id'].'\sample.exe',$output,$return_status);
//exec('C:\mingw\bin\g++ D:\xampp\htdocs\code_e_salsa\bigdata\1\sample.cpp -O3 -o D:\xampp\htdocs\code_e_salsa\bigdata\1\sample.exe',$output,$return_status);
//	print_r($output);
//	echo $return_status;
	
//	if($return_status==0)
//	{
//		echo "Successfully Compiled";
//	}
//	else if($return_status!=0)
//	{
//		echo "Compilation Failed";
//	}
?>

