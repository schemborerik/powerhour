<?php
    /******************************************************************************************
    //  "storemetadata.php"
    //  This page gets an array of videoIds and a playlistId through post. The page then scrapes
    //  the youtube pages corresponding to each id in order to find the metadata. The page then
    //  inserts the values into the database.
    //
    //  TODO
    //  -See "index.php" comments as this will have to be changed in order to complete the TODO
    //  tasks outlined there
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
    if($_POST['playlistid'] && $_POST['title'] && $_POST['vid1'] && $_POST['vid2'] && $_POST['vid3'] && $_POST['vid4']  && $_POST['length']) {  
        // Connect to the database
        $conn = sql_connect();
    
        // Store the videoIds and playlistId
        $playlistid = $_POST['playlistid'];
        $title = $_POST['title'];
        $v1 = $_POST['vid1'];
        $v2 = $_POST['vid2'];
        $v3 = $_POST['vid3'];
        $v4 = $_POST['vid4'];
        $len = $_POST['length'];
        echo "playlist length: " . $len;
        $p = 'yes';
            
            
        // Sanitize the variables
        $playlistid = $conn->real_escape_string($playlistid);
        $title = $conn->real_escape_string($title);
        $v1 = $conn->real_escape_string($v1);
        $v2 = $conn->real_escape_string($v2);
        $v3 = $conn->real_escape_string($v3);
        $v4 = $conn->real_escape_string($v4);
        $len = $conn->real_escape_string($len);
                        
        // Insert the metadata into the database as well as create a link between the playlistId and videoId
        $sql = "INSERT INTO `playlists` (`playlistId`, `playlistTitle`, `vid1`, `vid2`, `vid3`, `vid4`, `mostPopular`, `num_videos`) VALUES ('$playlistid', '$title', '$v1', '$v2', '$v3', '$v4', '$p', '$len') ON DUPLICATE KEY UPDATE `mostPopular` = 'yes';";
            
        // Execute the sql query
        if ($conn->query($sql) === FALSE) {
            echo "/nError: " . $sql . "<br>" . $conn->error;
        }
        
        // Close the database connection
        $conn->close();
    }
?>