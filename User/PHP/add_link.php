<?php

//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

$assignmentLink = $_GET['link'];
$activityID = 1234;
$studentanonID = mt_rand(2000, 7000);
$submissionDate = "2018-10-24";


echo '<br>';
echo ('Assignment link succesfully uploaded: '. $link);

//Call connection function (Opens connection to database)
include('./connectlocalhost.php');
$mysqli = get_mysqli_conn();

//SQL statement (Query)
$sql = "INSERT INTO assignment(AssignmentLink) VALUES (?)";

// Prepare statement (statement to be read by db server)
$stmt = $mysqli-> prepare($sql);

//Bind a PHP variable, $search as a string parameter
//"i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param("s", $assignmentLink);

//Execute prepared statement
$stmt->execute();

//Close statement
$stmt->close();


$sql = mysqli_query($mysqli, "SELECT `AssignmentID` FROM `assignment` WHERE `AssignmentLink` = '$assignmentLink'");
$assignmentIDFetch = mysqli_fetch_array($sql);
$assignmentID = $assignmentIDFetch['AssignmentID'];

//SQL statement (Query)
$sql = "INSERT INTO submission(ActivityID, StudentAnonID, AssignmentID, SubmissionDate) VALUES (?, ?, ?, ?)";

// Prepare statement (statement to be read by db server)
$stmt = $mysqli-> prepare($sql);

//Bind a PHP variable, $search as a string parameter
//"i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param("iiis", $activityID, $studentanonID, $assignmentID, $submissionDate);

//Execute prepared statement
$stmt->execute();

//Close statement
$stmt->close();

$sql = "INSERT INTO review(ActivityID, AssignmentID, StudentAnonID, ReviewDate, ReviewID) VALUES (?, ?, ?, ?, ?)";

$reviewDate = "2018-10-29";
$reviewID = 1;
// Prepare statement (statement to be read by db server)
$stmt = $mysqli-> prepare($sql);

//Bind a PHP variable, $search as a string parameter
//"i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param('iiisi', $activityID, $assignmentID, $studentanonID, $reviewDate, $reviewID);

//Execute prepared statement
$stmt->execute();

//Close statement
$stmt->close();

//Close mysqli connection
$mysqli->close();

echo '<br>';
echo '<br>';
echo $assignmentLink;
echo '<br>';
echo '<br>';
echo '<a href="student_profile.php">Back to your student profile page</a>';
echo '<br>';

?>