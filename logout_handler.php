<?php
    session_start();
    require('widgets.php');
    unset($_SESSION['user']);
    $_SESSION['notification'] = Widgets::notify("Logged out", Notify::Success);
    header("Location: index.php");
    exit();
?>