
<?php

//Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

echo '<form action="view_link.php" method="get">';

//Call connection function (Opens connection to database)
include('./connectlocalhost.php');
$mysqli = get_mysqli_conn();

//SQL statement (Query)
$sql = "SELECT r.AssignmentID FROM review r";

// Prepare statement (statement to be read by db server)
$stmt = $mysqli->prepare($sql);

//Execute prepared statement
$stmt->execute();

//Bind selected columns to PHP variables
$stmt->bind_result($ReturnAtt1);

//Fetch values
echo '<label for="AssignmentID">List of Submissions (by Assignment ID): </label>'; 
echo '<select name="AssignmentID">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $ReturnAtt1, $ReturnAtt1); 
}
echo '</select><br>';

echo '<br>';
echo '<input type="submit" value="View link assignment submission"/>';
echo '</form>';

echo '<br>';

//close statement and mysqli connection
$stmt->close();
$mysqli->close();

echo '<br>';
echo '<a href="student_profile.php">Back to your student profile page</a>';
echo '<br>';
?>