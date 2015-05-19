<?php
	/******************************************************************************************
	//	"getplaylist.php"
	//	This page pulls the videos in a playlist from the database
	//
	//	TODO
	//	-See "index.php" comments as this will have to be changed in order to complete the TODO
	//	tasks outlined there
	*******************************************************************************************/

	
	// Load sql_connect function 
	require('connecttodb.php');
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['playlistid']) {	
		// Connect to the database
		$conn = sql_connect();
	
		// Store the videoIds and playlistId
		$playlistid = $_POST['playlistid'];
                
		// Sanitize the variables
		$playlistid = $conn->real_escape_string($playlistid);
                
                
		$sql = "SELECT videos.video_id, videos.title
						FROM playlists_videos_map
						INNER JOIN videos ON playlists_videos_map.video_id = videos.video_id 
						WHERE playlists_videos_map.playlist_id='" . $playlistid . "'";
                               
		$result = $conn->query($sql);
                
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo $row["video_id"] . "<br>" . $row["title"] . "<br>";
			}
		}
		
		$conn->close();
                                        
	}
?>