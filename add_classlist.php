<?php 
//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

include('./my_connect.php');
$mysqli = get_mysqli_conn();

$filename=$_FILES["file"]["tmp_name"];		


if($_FILES["file"]["size"] > 0)
{
	$file = fopen($filename, "r");
	while (($getData = fgetcsv($file, 1000, ",")) !== FALSE)
	{
		$sql = "INSERT into studentinfo (StudentID,StudentName,StudentEmail) 
		values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
		$result = mysqli_query($mysqli, $sql);
		if(!isset($result))
		{
			echo 'failure';		
		}
		else {
			echo 'success';
		}
	}

	fclose($file);	
}

?>