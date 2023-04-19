<?php
    session_start();
    require_once("user.php");
    $user = (isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null);
    unset($_SESSION['current_post']);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="SquatchLogo.png">
        <title>Sightsquatch</title>
        </head>
        <body>
            <?php
                if(isset($_SESSION['notification'])){
                    echo $_SESSION['notification'];
                }
            ?>
            <div id="container" class="flex-col">
                <div id="title-bar" class="flex-row">
                    <img src="SquatchLogo.png">
                    <h1 class="expand">Sightsquatch</h1>
                    <?php
                        if($user != null){
                            echo "<p id='welcome-box' class='flex-col'>Welcome, {$user->username}</p>";
                        }
                    ?>
                </div>
                <div id="nav-bar" class="flex-row">
                    <a href="index.php" <?php if($page == "index") echo "class='current'"; ?>>Home</a>
                    <a href="sightings.php" <?php if($page == "sightings") echo "class='current'"; ?>>Sightings</a>
                    <a href="faq.php" <?php if($page == "faq") echo "class='current'"; ?>>FAQ</a>
                    <span class="expand"></span>
                    <?php
                        if($user == null){
                            echo "<a href='login.php'" . ($page == "login" ? "class='current'" : "") .">Login</a>";
                            echo "<a href='signup.php'" . ($page == "signup" ? "class='current'" : "") . ">Signup</a>";
                        }
                        else {
                            echo "<a href='logout_handler.php'>Logout</a>";
                        }
                    ?>
                </div>