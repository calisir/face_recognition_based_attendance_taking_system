<?php
include('logincheck.php'); // Includes Login Script

if(isset($_SESSION['login_user']) && isset($_SESSION['user_type'])){
    echo "logged in as ".$_SESSION['login_user'];
    
    if($_SESSION['user_type'] == "student"){
        header("location: attendance.php");
    } else if($_SESSION['user_type'] == "instructor"){
        header("location: instructor.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form in PHP with Session</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="main">
        <h1>PHP Login Session Example</h1>
        <div id="login">
            <h2>Login Form</h2>
            <form action="" method="post">
                <span><?php echo $error; ?></span><br/>
                <label>UserName :</label>
                <input id="name" name="username" placeholder="username" type="text">
                <label>Password :</label>
                <input id="password" name="password" placeholder="**********" type="password">
                <input name="submit" type="submit" value=" Login ">
                
            </form>
        </div>
    </div>
</body>
</html>