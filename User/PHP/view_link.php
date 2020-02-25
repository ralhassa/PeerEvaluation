<?php
session_start();
//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

$assignmentID = $_GET['AssignmentID'];
$_SESSION['AssignmentID'] = $assignmentID;

echo '<br>';
echo 'Link to assignment for Student Anonymous ID ';
echo $assignmentID;
echo ':';

//Call connection function (Opens connection to database)
include('./connectlocalhost.php');
$mysqli = get_mysqli_conn();

//SQL statement (Query)
$sql = "SELECT AssignmentLink FROM assignment WHERE AssignmentID =?";

// Prepare statement (statement to be read by db server)
$stmt = $mysqli->prepare($sql);

//Bind a PHP variable, $search as a string parameter
//"i" for integer, "d" for double, "s" for string, "b" for blob
$stmt->bind_param('i', $assignmentID);

//Execute prepared statement
$stmt->execute();

//Bind selected columns to PHP variables
$stmt->bind_result($ReturnAtt1);

echo '<br>';

while ($stmt->fetch()) 
{
echo '<br>';
echo "<a href='$ReturnAtt1'>Link</a>";
}
echo '</select><br>';

// close statement and mysqli connection
$stmt->close();
$mysqli->close();

echo '<br>';
echo '<a href="evaluation_form.php">Place a review</a>';
echo '<br>';
echo '<br>';
echo '<a href="student_profile.php">Back to your student profile page</a>';
echo '<br>';
?>