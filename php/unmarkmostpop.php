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

$conn = sql_connect();
$sql2 = "UPDATE `playlists` SET `mostPopular` = 'no' WHERE `mostPopular` = 'yes'";

if($conn->query($sql2) === TRUE){
    echo "Data updated";
} else{
    echo "Error: " . $sql2 . $conn->error;
}

$conn->close();

?>