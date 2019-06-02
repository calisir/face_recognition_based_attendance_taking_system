<?php

    if( $_POST["sid"] && $_POST["cid"])
    {
        $sid = $_POST['sid'];
        $cid = $_POST['cid'];
        $date = $_POST['classDate'];
        

        $servername = "127.0.0.1:3307";
        $username = "root";
        $password = "";
        $dbname = "attendance";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        
        $sql = "insert ignore into objection(student,class,date) values($sid,$cid,\"$date\");";
        $result = $conn->query($sql);
        
        $conn->close();
    }

    header("Location: /face/attendance.php"); /* Redirect browser */
    exit();
?>