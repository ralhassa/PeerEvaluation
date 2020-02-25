<?php 
//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

include('./my_connect.php');
$mysqli = get_mysqli_conn();

$query = "SELECT CourseID FROM courseinfo";

$stmt = $mysqli->prepare($query);

$stmt->execute();
$stmt->bind_result($courseID);

$data = array();

if ($stmt->errno){
    echo 'ERROR get_course.php';
}
else{
	while($stmt->fetch()){
		array_push($data,$courseID);
	}
}

echo json_encode($data);

$stmt->close();
$mysqli->close();

?>