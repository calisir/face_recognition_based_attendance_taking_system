<?php
    session_start(); // Starting Session
    $error=''; // Variable To Store Error Message
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Username or Password is invalid";
        }
        else
        {
            // Define $username and $password
            $username=$_POST['username'];
            $password=$_POST['password'];
            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
            $connection = new mysqli("127.0.0.1:3307", "root", "", "attendance");
            // SQL query to fetch information of registerd users and finds user match.
            $query = "SELECT * FROM student WHERE password='$password' AND username='$username'";
            $result = $connection->query($query);
            $rows = $result->num_rows;
            if ($rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['login_user'] = $row["id"]; // Initializing Session
                $_SESSION['user_name'] = $row["name"]; // Initializing Session
                $_SESSION['user_surname'] = $row["surname"]; // Initializing Session
                $_SESSION['user_type'] = "student";            
                header("location: attendance.php"); // Redirecting To Student Page
            } else {
                $query = "SELECT * FROM instructor WHERE password='$password' AND username='$username'";
                $result = $connection->query($query);
                $rows = $result->num_rows;
                if ($rows == 1) {
                    $row = $result->fetch_assoc();
                    $_SESSION['login_user'] = $row["id"]; // Initializing Session 
                    $_SESSION['user_name'] = $row["name"]; // Initializing Session
                    $_SESSION['user_surname'] = $row["surname"]; // Initializing Session
                    $_SESSION['user_type'] = "instructor";    
                    header("location: instructor.php"); // Redirecting To Instructor Page
                } else {
                    $error = "Username or Password is invalid";                    
                }
            }
            $connection->close(); // Closing Connection
        }
    }
?>