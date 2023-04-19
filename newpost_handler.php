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

    if(empty(trim($_POST['title'])) || empty(trim($_POST['body'])) || empty(trim($_POST['date'])) || empty(trim($_POST['location']))){
        $_SESSION['notification'] = Widgets::notify("Inputs cannot be blank", Notify::Fail);
        $_SESSION['form'] = $_POST;
        header("Location: newpost.php");
        exit();
    }

    // Try to create the post in the database
    $db = new DB();
    $result = $db->createPost($_POST['title'], $_POST['body'], $_POST['date'], $_POST['location'], $user->id);

    // Exit if the post was not created
    if($result < 0) {
        $_SESSION['notification'] = Widgets::notify("A server error occurred");
        $_SESSION['form'] = $_POST;
        header("Location: newpost.php");
        exit();
    }

    // Save uploaded images and add them to the file
    if(!empty(array_filter($_FILES['img']['name']))) {
        foreach ($_FILES['img']['tmp_name'] as $i => $path) {
            if($_FILES['img']['error'][$i] == UPLOAD_ERR_OK && getimagesize($path) !== false) {
                $newPath = "uploaded_images/" . $result . "-" . $i;
                if(move_uploaded_file($path, $newPath)) {
                    $db->addImageToPost($result, $newPath);
                }
            }  
        }
    }

    header("Location: index.php");
    exit();

    //Array ( [img] => Array ( [name] => Array ( [0] => GraphStudent.png [1] => Graph.png ) [full_path] => Array ( [0] => GraphStudent.png [1] => Graph.png ) [type] => Array ( [0] => image/png [1] => image/png ) [tmp_name] => Array ( [0] => /opt/lampp/temp/phpzIMcvV [1] => /opt/lampp/temp/php6KXvum ) [error] => Array ( [0] => 0 [1] => 0 ) [size] => Array ( [0] => 56222 [1] => 38637 ) ) )
?>
