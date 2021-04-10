<?php
session_start();
include '../includes/misc.inc';

$display_str = "";
$rank = 1;
$get_ranking = "SELECT `id`, `fname`, `sname`, `score` FROM `participant_info` ORDER BY `score` DESC";
$result = mysqli_query($connect,$get_ranking);

$display_str = "<h2 align='center' class='text-primary'>";
$display_str .= "Leaderboard";
$display_str .= "</h2><BR>";

$display_str .= "<TABLE class='table table-responsive table-hover'>";
	while($row = mysqli_fetch_array($result))
	{
		//extract($row);
		if($row['id']==$_SESSION['id'])
			$display_str .= "<TR bgcolor='#fff0b3'>";
		else 
			$display_str .= "<TR>";
		
//		$fname_str = explode(' ',$row['fname']);
//		$sname_str = explode(' ',$row['sname']);
		
		$display_str .= "<TD align='center'>";
			$display_str .="<h4>";
				$display_str .= $rank;
			$display_str .="</h4>";
		$display_str .= "</TD>"; 
		
			$display_str .= "<TD align='center'> <STRONG>";
			$display_str .=  $row['fname'];
			$display_str .= "<BR>";
			$display_str .=  $row['sname'];
			$display_str .= "</STRONG></TD>";
		
		$display_str .= "<TD align='center'>";
			$display_str .="<h4>";
				$display_str .= $row['score'];
			$display_str .="</h4>";
		$display_str .= "</TD>";
		
		$rank += 1;
		$display_str .= "</TR>";
	}
$display_str .= "</TABLE>";

echo $display_str;
?>