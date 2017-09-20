<?php
	/******************************************************************************************
	//	"storeplaylist.php"
	//	Stores videos and titles in database. Stores link between video and playlist.
	*******************************************************************************************/
	
	require('dbwrapper.php');
	
	$db = new Db();
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['videos'] && $_POST['playlistid'] && $_POST['title']) {		

		$playlistid = $db -> quote($_POST['playlistid']);
		$title = $db -> quote($_POST['title']);
		$videos = $_POST['videos'];
		$len = count($videos);
		
		$v1 = $db -> quote($videos[0]['video_id']);
		$v2 = $db -> quote($videos[$len/4]['video_id']);
		$v3 = $db -> quote($videos[$len/2]['video_id']);
		$v4 = $db -> quote($videos[$len*3/4]['video_id']);
		
		// Insert the metadata into the database as well as create a link between the playlistId and videoId
		$sql = "INSERT IGNORE INTO playlists (playlistId, playlistTitle, vid1, vid2, vid3, vid4, num_videos) VALUES ($playlistid, $title, $v1, $v2, $v3, $v4, $len)";
		// Execute the sql query
		if ($db -> query($sql) === FALSE) {
			echo "/nError: " . $sql . "<br>" . $db -> error();
		}
		
		// Iterate through all the videoIds
		foreach($videos as $video) {
			$id = $db -> quote($video['video_id']);
			$title = $db -> quote($video['title']);

			$sql = array();
			// Insert the metadata into the database as well as create a link between the playlistId and videoId
			$sql[] = "INSERT IGNORE INTO `videos` (`video_id`, `title`) VALUES ($id, $title)";
			$sql[] = "INSERT IGNORE INTO `playlists_videos_map` (`playlist_id`, `video_id`) VALUES ($playlistid, $id)";
			
			$results = $db -> transaction($sql);
		}
	}
?>