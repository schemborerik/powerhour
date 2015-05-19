<?php
	/******************************************************************************************
	//	"getmetadata.php"
	//	This page connects to the database, then queries it for the artist and song
	//	which is echoed back.
	//
	//	TODO
	//	-Nothing
	*******************************************************************************************/

	// Load sql_connect function 
	require('connecttodb.php');
	
	// Connect to the database
	$conn = sql_connect();
	
	// Store the videoId from GET
	$id = $_GET['id'];
	
	// Get the artist and song matching the videoId from the databse
	$sql = "SELECT title FROM videos WHERE video_id='" . $id."';";
	$result = $conn->query($sql);
	
	// echo the artist and song separated by "<br>"
	$row = $result->fetch_assoc();
	echo $row["title"];
	
	// Close the connection
	$conn->close();
?>