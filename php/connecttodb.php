<?php
	/******************************************************************************************
	//	"connecttodb.php"
	//	This page contains the function to connect to the database
	//
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
?>