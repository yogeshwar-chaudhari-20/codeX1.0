<?php
include '../includes/misc.inc';
$display_str = "";
$rank = 1;
$get_ranking = "SELECT `id`, `fname`, `sname`, `score` FROM `participant_info` ORDER BY `score` DESC";
$result = mysqli_query($connect,$get_ranking);

$display_str = "<h2 align='center'>";
$display_str .= "L E A D E R B O A R D";
$display_str .= "</h2><BR>";

$display_str .= "<TABLE class='table table-striped'>";
$display_str .= "<TH style='text-align:center'>R A N K</TH>";
$display_str .= "<TH style='text-align:center'>T E A M - M E M B E R S</TH>";
$display_str .= "<TH style='text-align:center'>P O I N T S</TH>";

	while($row = mysqli_fetch_array($result))
	{
		extract($row);

		$display_str .= "<TR>";
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