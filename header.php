<?php
    session_start();
    require_once("user.php");
    $user = (isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null);
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="squatchicon.png">
        <title>Sightsquatch</title>
        </head>
        <body>
            <div id="title-bar" class="flex-row">
                <img src="squatchicon.png">
                <h1  class="expand">Sightsquatch</h1>
                <?php
                    if($user != null){
                        echo "<p>Welcome, {$user->username}</p>";
                    }
                ?>
            </div>
            <div id="nav-bar" class="flex-row">
                <a href="index.php">Home</a>
                <a href="sightings.php">Sightings</a>
                <a href="faq.php">FAQ</a>
                <span class="expand"></span>
                <?php
                    if($user == null){
                        echo "<a href='login.php'>Login</a>";
                        echo "<a href='signup.php'>Signup</a>";
                    }
                    else {
                        echo "<a href='logout_handler.php'>Logout</a>";
                    }
                ?>
            </div>