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

		$sql = "UPDATE `playlists` SET `play_count` = play_count + 1 WHERE `playlistId` ='$playlistid';";
    
		$result = $conn->query($sql);
		
		if($conn->affected_rows > 0) {
			$sql = "SELECT * FROM `playlists` WHERE `playlistId` = '$playlistid';";
			$result = $conn->query($sql);
			$result = $result->fetch_assoc();
			echo $result['playlistTitle'] . "<br>" . $result['num_videos'];
		}
		
		$conn->close();

	}
?>