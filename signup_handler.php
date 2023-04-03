<?php
    session_start();
    require_once('db.php');
    require_once('widgets.php');

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
            break;
        case CreateUserResult::EmailTaken:
            $_SESSION['notification'] = Widgets::notify("Email already in use", Notify::Fail);
            break;
        case CreateUserResult::PasswordMismatch:
            $_SESSION['notification'] = Widgets::notify("Passwords did not match", Notify::Fail);
            break;
    }

    header("Location: $redirect");
    exit();
?>