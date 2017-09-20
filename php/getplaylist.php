<?php
	/******************************************************************************************
	//	"getplaylist.php"
	//	Gets videos in a playlistId from database
	//
	*******************************************************************************************/

	require('dbwrapper.php');
	
	$db = new Db();
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['playlistid']) {	
		// Store the videoIds and playlistId
		$playlistid = $db -> quote($_POST['playlistid']);
		
		$sql = "SELECT playlistTitle, num_videos FROM `playlists` WHERE `playlistId` = $playlistid";
		$row = $db -> select_one($sql);
		
		$result['playlist'] = $row;
		
		if($row) {
			$sql = "UPDATE playlists SET play_count = play_count + 1 WHERE playlistId=$playlistid";
			if($db -> query($sql) === FALSE)
				echo json_encode("/nError: " . $sql . "<br>" . $db -> error());

			$sql = "SELECT videos.video_id, videos.title
					FROM playlists_videos_map
					INNER JOIN videos ON playlists_videos_map.video_id = videos.video_id 
					WHERE playlists_videos_map.playlist_id= $playlistid";

			$rows = $db -> select($sql);
	
			$result['videos'] = $rows;
			echo json_encode($result);
		} else {
			echo json_encode(null);
		}		
	}
?>