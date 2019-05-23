<?php

    if( $_POST["sid"] && $_POST["cid"])
    {
        $sid = $_POST['sid'];
        $cid = $_POST['cid'];
        echo $sid;

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

        
        $sql = "insert into objection(student,class) values($sid,$cid);";
        $result = $conn->query($sql);
        
        $conn->close();
    }

    header("Location: /attendance/attendance.php"); /* Redirect browser */
    exit();
?>