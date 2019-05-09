<?php
    echo "Hi";

    $sid = $_POST['sid'];
    $cid = $_POST['cid'];

	$servername = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $dbname = "attendance";

    echo $sid;
    echo $cid;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


    $sql = "UPDATE attendance SET present = 1 WHERE student = ".$sid." AND class = ".$cid.";";
    $result = $conn->query($sql);



    
    if ($result->num_rows > 0) {
        
        $result->free();
    } 

    $conn->close();

?>