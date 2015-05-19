<?php
	/******************************************************************************************
	//	"server.php"
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
	
	// Connect to the database
	$conn = sql_connect();
							
							
	$sql = "SELECT * FROM playlists ORDER BY play_count DESC LIMIT 6";
														 
	$result = $conn->query($sql);
	
	$mostpopularids = [];
	$titles = [];
	$vid1 = [];
	$vid2 = [];
	$vid3 = [];
	$vid4 = [];
							
	if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				 array_push($mostpopularids, $row["playlist_id"]);
				 array_push($titles, $row["playlist_title"]);
				 array_push($vid1, $row["sample_video_1"]);
				 array_push($vid2, $row["sample_video_2"]);
				 array_push($vid3, $row["sample_video_3"]);
				 array_push($vid4, $row["sample_video_4"]);
			}
	}
	
	$conn->close();
?>