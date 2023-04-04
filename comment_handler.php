<?php
    session_start();
    require_once('db.php');
    require_once('widgets.php');
    require_once("user.php");
    $user = (isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null);
    if(!isset($_SESSION['current_post'])){
        header("Location: index.php");
        exit();
    }
    
    $postID = $_SESSION['current_post'];
    $commentBody = trim($_POST['comment']);
    if($user == null || trim($_POST['comment']) === ""){
        header("Location: post.php?post_id=$postID");
        exit();
    }

    // Try to create the user in the database
    $db = new DB();
    $result = $db->createComment($postID, $user->id, $commentBody);
    header("Location: post.php?post_id=$postID");
    exit();
?>