<?php
    session_start();
    require_once('db.php');
    require_once('widgets.php');
    require_once("user.php");
    $user = (isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null);

    $db = new DB();
    $comment = $db->fetchComment($_GET['comment_id']);

    if(!isset($_SESSION['current_post']) || empty($comment)){
        $_SESSION['notification'] = Widgets::notify("A server error occurred", Notify::Fail);
        header("Location: index.php");
        exit();
    }

    $postID = $_SESSION['current_post'];
    if($user != null && ($user->isAdmin || $user->id == $comment['posterID'])){
        if($db->deleteComment($comment['id'])) {
            $_SESSION['notification'] = Widgets::notify("Comment deleted", Notify::Success);
            header("Location: post.php?post_id=$postID");
            exit();
        }
        else{
            $_SESSION['notification'] = Widgets::notify("A server error occurred", Notify::Fail);
            header("Location: post.php?post_id=$postID");
            exit();
        }
    }
    else {
        $_SESSION['notification'] = Widgets::notify("Operation forbidden", Notify::Fail);
        header("Location: post.php?post_id=$postID");
        exit();
    }
?>