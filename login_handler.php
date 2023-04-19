<?php
    session_start();
    require_once('user.php');
    require_once('db.php');
    require_once('widgets.php');

    // Try to fetch the user from the database
    $db = new DB();
    $user = $db->fetchUser($_POST['email']);
    $redirect = "login.php";

    // Authenticate the user
    if ($user == null || !$user->authenticate($_POST['email'], $_POST['password'])){
        $_SESSION['notification'] = Widgets::notify("Incorrect credentials", Notify::Fail);
        $_SESSION['form'] = $_POST;
    }
    else {
        $redirect = "index.php";
        $_SESSION['user'] = serialize($user);
        $_SESSION['notification'] = Widgets::notify("Logged in successfully", Notify::Success);
    }

    header("Location: $redirect");
    exit();
?>