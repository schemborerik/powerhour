<?php 
function sql_connect() {
        $servername = "localhost";
        $username = "root";
        $password = null;//"UNhRVujrXDXywhxH";
        $database = 'powerhour';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //mysqli_select_db($conn,"powerhour");
        return $conn;
    }
    
    // Connect to the database
$conn = sql_connect();

$sql = "SELECT * FROM `playlists` WHERE `mostPopular` = 'yes'";

$result = $conn->query($sql);
//echo $result;

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