<?php
	$conn = new mysqli('localhost', 'root', '', 'votes');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>