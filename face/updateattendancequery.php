<?php
    

    if( $_POST["sid"] && $_POST["cid"] && isset($_POST['present']))
    {
        $sid = $_POST['sid'];
        $cid = $_POST['cid'];
        $present = $_POST['present'];

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

        if ($present == 1){
            $sql = "UPDATE attendance SET present = 1 WHERE student = ".$sid." AND class = ".$cid.";";
            $result = $conn->query($sql);
        }

        $sql = "DELETE FROM objection WHERE student = ".$sid." AND class = ".$cid.";";
        $result = $conn->query($sql);        

        $conn->close();
    }

    header("Location: /face/instructor.php"); /* Redirect browser */
    exit();
?>