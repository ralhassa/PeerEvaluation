<?php
session_start();
//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

$spellGrammar = $_GET['spell'];
$format = $_GET['format'];
$comments = $_GET['comments'];
$rating = $_GET['rating']; 
$assignmentID = $_SESSION['AssignmentID'];

echo '<br>';
echo 'Review succesfully uploaded for Assignment ';
echo $assignmentID;
echo ':';
echo '<br>';
//Call connection function (Opens connection to database)
include('./connectlocalhost.php');
$mysqli = get_mysqli_conn();

//SQL statement (Query)
//This part is kind of redundant - let's see if we can put it all in one SQL statement
$sql = "UPDATE review SET `Feedback-Spelling/Grammar`=  '" . $spellGrammar . "' WHERE AssignmentID = " . $assignmentID;
echo '<br>';
echo 'Spelling/Grammar: ';
echo $spellGrammar;
$stmt = $mysqli-> prepare($sql);
$stmt->execute();
$stmt->close();

$sql = "UPDATE review SET `Feedback-Format`=  '" . $format . "' WHERE AssignmentID = " . $assignmentID;
echo '<br>';
echo 'Format: ';
echo $format;
$stmt = $mysqli-> prepare($sql);
$stmt->execute();
$stmt->close();

$sql = "UPDATE review SET `Feedback-Comments`=  '" . $comments . "' WHERE AssignmentID = " . $assignmentID;
echo '<br>';
echo 'Comments: ';
echo $comments;
$stmt = $mysqli-> prepare($sql);
$stmt->execute();
$stmt->close();

$sql = "UPDATE review SET `Feedback-OverallRating`=  '" . $rating . "' WHERE AssignmentID = " . $assignmentID;
echo '<br>';
echo 'Overall Rating: ';
echo $rating;
$stmt = $mysqli-> prepare($sql);
$stmt->execute();
$stmt->close();

echo '<br>';
echo '<br>';
echo '<a href="student_profile.php">Back to your student profile page</a>';
echo '<br>';

?>