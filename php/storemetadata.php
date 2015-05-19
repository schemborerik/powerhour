<?php
	/******************************************************************************************
	//	"storemetadata.php"
	//	This page gets an array of videoIds and a playlistId through post. The page then
	//	inserts	the values into the database.
	//
	*******************************************************************************************/


	// Load sql_connect function 
	require('connecttodb.php');
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['ids'] && $_POST['playlistid'] && $_POST['metadata']) {	
		// Connect to the database
		$conn = sql_connect();
	
		// Store the videoIds and playlistId
		$playlistid = $_POST['playlistid'];
		$playlistid = $conn->real_escape_string($playlistid);
		
		$ids = $_POST['ids'];
		$titles = $_POST['metadata'];
		
		// Iterate through all the videoIds
		for($i=0; $i<sizeof($ids); $i++) {
			$id = $ids[$i];
			$title = $titles[$i];
		
			// Sanitize the variables
			$id = $conn->real_escape_string($id);
			$title = $conn->real_escape_string($title);
			
			// Insert the metadata into the database as well as create a link between the playlistId and videoId
			$sql = "INSERT IGNORE INTO videos (video_id, title)
			VALUES ('".$id."', '".$title."');";
			$sql .= "INSERT IGNORE INTO playlists_videos_map (playlist_id, video_id)
			VALUES ('".$playlistid."', '".$id."');";
			
			// Execute the sql query
			if ($conn->multi_query($sql) === FALSE) {
				echo "/nError: " . $sql . "<br>" . $conn->error;
			}
			// Free up the result
			do
			{
				$result = $conn->store_result();
			}while($conn->next_result());
		}
		// Close the database connection
		$conn->close();
	}
?>