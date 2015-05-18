<?php
	/******************************************************************************************
	//	"getmetadata.php"
	//	This page connects to the database, then queries it for the artist and song
	//	which is echoed back.
	//
	//	TODO
	//	-Nothing
	*******************************************************************************************/

	// Connects to the database and returns a connection object 
	function sql_connect() {
		$servername = "localhost";
		$username = "powerhour";
		$password = "UNhRVujrXDXywhxH";

		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_select_db($conn,"powerhour");
		return $conn;
	}
	
	// Connect to the database
	$conn = sql_connect();
	
	// Store the videoId from GET
	$id = $_GET['id'];
	
	// Get the artist and song matching the videoId from the databse
	$sql = "SELECT title FROM videos WHERE video_id='" . $id."';";
	$result = $conn->query($sql);
	
	// echo the artist and song separated by "<br>"
	$row = $result->fetch_assoc();
	echo $row["title"];
	
	// Close the connection
	$conn->close();
?>