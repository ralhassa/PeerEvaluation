<?php
// Function to obtain mysqli connection.
function get_mysqli_conn()
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = 'root';
    $dbname = 'peerreview7';
    $port = 3307;
    $mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $port);
    if ($mysqli->connect_errno) 
    {
    echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    }
    return $mysqli;
}

?>