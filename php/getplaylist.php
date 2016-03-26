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


	// Because this script is querying up to 50 pages from youtube, it can take awhile to complete.
	// Therefore the timeout should be increased.
	set_time_limit(60);
	
	// Connects to the database and returns a connection object 
	function sql_connect() {
		$servername = "localhost";
		$username = "root";
		$password = null;//"UNhRVujrXDXywhxH";
		$database = "powerhour";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		//mysqli_select_db($conn,"powerhour");
		return $conn;
	}
	
	// Make sure that the videoIds and playlistId were sent
	if($_POST['playlistid']) {	
		// Connect to the database
		$conn = sql_connect();
	
		// Store the videoIds and playlistId
		$playlistid = mysql_real_escape_string($_POST['playlistid']);
                
		// Sanitize the variables
		//$playlistid = $conn->real_escape_string($playlistid);
                
                
		$sql = "SELECT videos.video_id, videos.title
						FROM playlists_videos_map
						INNER JOIN videos ON playlists_videos_map.video_id = videos.video_id 
						WHERE playlists_videos_map.playlist_id= '$playlistid'";

                               
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