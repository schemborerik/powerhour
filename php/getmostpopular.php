<?php
	/******************************************************************************************
	//	"getmostpopular.php"
	//	Gets the 6 most popular playlists from database
	//
	*******************************************************************************************/

	require('dbwrapper.php');
	
	$db = new Db();
	
	$rows = $db -> select("SELECT * FROM playlists ORDER BY play_count DESC LIMIT 6");
	//echo $rows;
	
	$mostpopularids = [];
	$titles = [];
	$vid1 = [];
	$vid2 = [];
	$vid3 = [];
	$vid4 = [];
	
	foreach($rows as $row) {
		$mostpopularids[] = $row["playlistId"];
		$titles[] = $row["playlistTitle"];
		$vid1[] = $row["vid1"];
		$vid2[] = $row["vid2"];
		$vid3[] = $row["vid3"];
		$vid4[] = $row["vid4"];
	}
?>