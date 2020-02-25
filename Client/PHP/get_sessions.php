<?php

//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

include('./my_connect.php');
$mysqli = get_mysqli_conn();

// assume that system is for 1 instructor
$query = "SELECT ActivityID, CourseID, AssignmentName FROM activityinfo";

$stmt = $mysqli->prepare($query);

$stmt->execute();
$stmt->bind_result($sessionID, $courseID, $name);

$data = array();

if ($stmt->errno){
	echo 'ERROR get_sessions.php';
}
else{
	while($stmt->fetch()){
		$row = array (
			"sessionID" => $sessionID,
			"courseID" => $courseID,
			"assignmentName" => $name,
		);
		array_push($data, $row);
	}
}
echo json_encode($data);

?>