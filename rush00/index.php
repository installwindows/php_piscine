<?php
$servername = "localhost:3307";
$username = "root";

$conn = mysqli_connect("/tmp/socket", "root");; 
if(!$conn)
{
	echo "Connection failed: " . mysqli_connect_error() . "\n";
	return ;
}
echo "Success!\n";
