<?php
	//$servername = "localhost";
  	//$username = "u880905156_smart";
  	//$password = "missimmit";
  	//$dbname = "u880905156_smart";

  	$servername = "localhost";
  	$username = "root";
  	$password = "";
  	$dbname = "u880905156_smart";
  	 //Create connection
  	$conn = new mysqli($servername, $username, $password, $dbname);
  	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
?>
