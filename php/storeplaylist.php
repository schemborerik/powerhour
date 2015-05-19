<?php
	/******************************************************************************************
	//	"storemetadata.php"
	//	This page gets an array of videoIds and a playlistId through post. The page then scrapes
	//	the youtube pages corresponding to each id in order to find the metadata. The page then
	//	inserts	the values into the database.
	//
	//	TODO
	//	-See "index.php" comments as this will have to be changed in order to complete the TODO
	//	tasks outlined there
	*******************************************************************************************/

	// Load sql_connect function 
	require('connecttodb.php');
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['playlistid'] && $_POST['title'] && $_POST['vid1'] && $_POST['vid2'] && $_POST['vid3'] && $_POST['vid4']  && $_POST['length']) {	
		// Connect to the database
		$conn = sql_connect();
	
		// Store the videoIds and playlistId
		$playlistid = $_POST['playlistid'];
		$title = $_POST['title'];
		$v1 = $_POST['vid1'];
		$v2 = $_POST['vid2'];
		$v3 = $_POST['vid3'];
		$v4 = $_POST['vid4'];
		$len = $_POST['length'];
			
			
		// Sanitize the variables
		$playlistid = $conn->real_escape_string($playlistid);
		$title = $conn->real_escape_string($title);
		$v1 = $conn->real_escape_string($v1);
		$v2 = $conn->real_escape_string($v2);
		$v3 = $conn->real_escape_string($v3);
		$v4 = $conn->real_escape_string($v4);
		$len = $conn->real_escape_string($len);
						
		// Insert the metadata into the database as well as create a link between the playlistId and videoId
		$sql = "INSERT IGNORE INTO playlists (playlist_id, playlist_title, sample_video_1, sample_video_2, sample_video_3, sample_video_4, num_videos)
		VALUES ('" . $playlistid . "', '" . $title .  "', '" . $v1 . "', '" . $v2 . "', '" . $v3 . "', '" . $v4 . "', '" . $len . "');";
			
		// Execute the sql query
		if ($conn->query($sql) === FALSE) {
			echo "/nError: " . $sql . "<br>" . $conn->error;
		}
		
		// Close the database connection
		$conn->close();
	}
?>