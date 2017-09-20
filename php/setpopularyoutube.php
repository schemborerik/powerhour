<?php 
require('dbwrapper.php');
	
	$db = new Db();
			
			// Connect to the database
	$conn = sql_connect();

	$sql = "SELECT * FROM `playlists` WHERE `mostPopular` = 'yes'";

	$rows = $db -> select($sql);

	$mostpopularids = [];
	$titles = [];
	$vid1 = [];
	$vid2 = [];
	$vid3 = [];
	$vid4 = [];
							
	if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				 array_push($mostpopularids, $row["playlistId"]);
				 array_push($titles, $row["playlistTitle"]);
				 array_push($vid1, $row["vid1"]);
				 array_push($vid2, $row["vid2"]);
				 array_push($vid3, $row["vid3"]);
				 array_push($vid4, $row["vid4"]);
			}
	}

?>