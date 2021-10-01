<?php
    require_once('../../../connection.php');


if(isset($_POST["report"]))
{
	
		//$file_name = 'Order Data.csv';
		//header('Content-Description: File Transfer');
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Desposition: attachment; filename=Incomedata.csv');
		//$output = die("Can't open php://output");
		$output = fopen("php://output", "w");
		fputcsv($output, array('Id','Date','Section','Amount'));
		$query = "SELECT * FROM income WHERE date >= '".$_POST["sdate"]."' AND date <= '".$_POST["edate"]."' ORDER BY date DESC";
		
		$result = mysqli_query($conn,$query);
		
	
			
		while($row = mysqli_fetch_assoc($result))
			{
				fputcsv($output,$row);
			}
		fclose($output);
			
	
}
?>