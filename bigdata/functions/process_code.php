<?php
	$_SESSION['id'] = 1;
	$filename = "sample";
	
	$formatted_code = $_POST['formatted_code'];
	$code = str_replace("\t", " ", $formatted_code);
	
	if(file_exists("../".$_SESSION['id']))
	{
		shell_exec("del ../1/sample.cpp");
		//shell_exec("del ../".$_SESSION['id']."/".$filename.".cpp");
		//shell_exec("del ../".$_SESSION['id']."/".$filename.".exe");
		exit();
		
		$fd = fopen("../".$_SESSION['id']."/".$filename.".cpp","w");
		fwrite($fd, $code);
		fclose($fd);
	}
	else 
	{
		mkdir("../".$_SESSION['id'],0777,true);
		$fd = fopen("../".$_SESSION['id']."/".$filename.".cpp","w");
		fwrite($fd, $code);
		fclose($fd);
	}
	
	exec('C:\mingw\bin\g++ D:\xampp\htdocs\codeX1.0\bigdata\\'.$_SESSION['id'].'\sample.cpp -O3 -o D:\xampp\htdocs\codeX1.0\bigdata\\'.$_SESSION['id'].'\sample.exe 2>D:\xampp\htdocs\codeX1.0\bigdata\\'.$_SESSION['id'].'\error.txt',$output,$return_status);
	if($return_status==0)
	{
		$result=shell_exec('D:\xampp\htdocs\codeX1.0\bigdata\\'.$_SESSION['id'].'\sample.exe');
		$console_msg = "Successfully Compiled <BR>";
		$console_msg .= $result;
		echo $console_msg;
	}
	else if($return_status!=0)
	{
		//$errors=shell_exec('C:\mingw\bin\g++ D:\xampp\htdocs\codeX1.0\bigdata\\'.$_SESSION['id'].'\sample.cpp');
		$console_msg = "Compilation Failed <BR>";
		$error_msg = "";
		try{
			$fd = fopen('..\\'.$_SESSION['id'].'\error.txt','r');
		
			while (($buffer = fgets($fd)) !== false) 
			{
				$error_msg .= $buffer."<BR>";
			}
		}
		catch(Exception $e)
		{
			$error_msg = "Cant Load the error messages.";
		}
		
		echo $console_msg.$error_msg;
	}
	exit();
?>