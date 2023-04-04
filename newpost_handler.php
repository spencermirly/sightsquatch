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
    // if($result){
    //     $numImgs = count($_FILES['img']['name']);
    //     for($i = 0; $i < $numImgs; $i++){

    //     }
    // }
    echo print_r($_FILES, true);
    echo print_r(empty(array_filter($_FILES['img']['name'])), true);
    // header("Location: index.php");
    // exit();

    //Array ( [img] => Array ( [name] => Array ( [0] => GraphStudent.png [1] => Graph.png ) [full_path] => Array ( [0] => GraphStudent.png [1] => Graph.png ) [type] => Array ( [0] => image/png [1] => image/png ) [tmp_name] => Array ( [0] => /opt/lampp/temp/phpzIMcvV [1] => /opt/lampp/temp/php6KXvum ) [error] => Array ( [0] => 0 [1] => 0 ) [size] => Array ( [0] => 56222 [1] => 38637 ) ) )
?>
