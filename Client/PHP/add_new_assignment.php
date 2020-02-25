<?php 
//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

include('./my_connect.php');
$mysqli = get_mysqli_conn();

$course = $_POST['course']; 
$assginmentName = $_POST['name']; 
$submitDate = $_POST['submitDate']; 
$reviewDate = $_POST['reviewDate'];
$reviewers = (int)$_POST['reviewers'];

$query = "INSERT INTO activityinfo (CourseID, AssignmentName, SubmissionDeadline, ReviewDeadline, NumberofReviewers) VALUES (?,?,?,?,?)";

$stmt = $mysqli->prepare($query);

// fix datatype
$stmt->bind_param('ssssi', $course, $assginmentName, $submitDate, $reviewDate, $reviewers);

$stmt->execute();

if ($stmt->errno){
    echo 'Error';
}
else{
	echo 'Success';
}

$stmt->close();
$mysqli->close();

?>