<?php
    session_start();
    require_once('db.php');
    require_once('widgets.php');
    require_once("user.php");
    $user = (isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null);
    if($user == null){
        header("Location: index.php");
        exit();
    }

    // Try to create the user in the database
    $db = new DB();
    $result = $db->createPost($_POST['title'], $_POST['body'], $_POST['date'], $_POST['location'], $user->id);
    echo print_r($result, true);
    header("Location: index.php");
    exit();
?>