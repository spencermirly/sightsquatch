<?php
    session_start();
    require('widgets.php');
    unset($_SESSION['user']);
    $_SESSION['notification'] = Widgets::notify("Logged out");
    header("Location: index.php");
    exit();
?>