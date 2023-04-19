<?php
    session_start();
    require_once('db.php');
    require_once('widgets.php');

    if(empty(trim($_POST['username'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['retype']))){
        $_SESSION['notification'] = Widgets::notify("Inputs cannot be blank", Notify::Fail);
        $_SESSION['form'] = $_POST;
        header("Location: signup.php");
        exit();
    }

    // Try to create the user in the database
    $db = new DB();
    $result = $db->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['retype'], 0);
    $redirect = "signup.php";

    // Set notification and redirect location based on result
    switch($result) {
        case CreateUserResult::Success:
            $redirect = "login.php";
            $_SESSION['notification'] = Widgets::notify("Account registred successfully", Notify::Success);
            break;
        case CreateUserResult::ServerError:
            $_SESSION['notification'] = Widgets::notify("A server error occurred", Notify::Fail);
            $_SESSION['form'] = $_POST;
            break;
        case CreateUserResult::EmailTaken:
            $_SESSION['notification'] = Widgets::notify("Email already in use", Notify::Fail);
            $_SESSION['form'] = $_POST;
            break;
        case CreateUserResult::PasswordMismatch:
            $_SESSION['notification'] = Widgets::notify("Passwords did not match", Notify::Fail);
            $_SESSION['form'] = $_POST;
            break;
        case CreateUserResult::InvalidEmail:
            $_SESSION['notification'] = Widgets::notify("Invalid email address", Notify::Fail);
            $_SESSION['form'] = $_POST;
            break;
    }

    header("Location: $redirect");
    exit();
?>