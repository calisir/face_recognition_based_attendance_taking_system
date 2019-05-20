<?php    

    include("logincheck.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['login_user'])){
        header('location: login/coollogin.php'); // Redirecting To Home Page
    }
    
    // Storing Session
    $LOGGED_USER = $_SESSION['login_user'];
    $LOGGED_NAME = $_SESSION['user_name']; 
    $LOGGED_SURNAME = $_SESSION['user_surname'] ;
    
?>