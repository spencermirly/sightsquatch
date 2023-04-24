<?php
    $page = "";
    require('header.php');
    require_once('db.php');
    require_once('widgets.php');
    
    if(!isset($_GET['post_id'])){
        header("Location: sightings.php");
        exit();
    }

    $db = new DB();
    $post = $db->fetchPost($_GET['post_id']);

    $postID = $post['id'];
    $title = htmlspecialchars($post['title']);
    $body = htmlspecialchars($post['body']);
    $poster = htmlspecialchars($post['username']);
    $location = htmlspecialchars($post['sightingLoc']);
    $date = htmlspecialchars($post['sightingDate']);
    $commentCount = htmlspecialchars($post['comments']);

    $comments = $db->fetchComments($_GET['post_id']);
    $_SESSION['current_post'] = $_GET['post_id'];
?>
    <div id="login-signup" class="flex-row">
        <div id="view-post" class="flex-col expand">
            <div id="post-section">
                <?php
                    echo "<div id='title'section' class='flex-row'><h2 class='expand'>$title</h2>";
                    if($user != null && ($user->isAdmin || $user->id == $post['posterID'])){
                        echo "<button class='delete-post' data-id='$postID'><img src=trash-can.svg></button>";
                    }
                    echo "</div>";
                    $images = $db->fetchImages($_GET['post_id']);
                    if(!empty($images)){
                        echo "<div id='img-section' class='flex-row'>";
                        foreach($images as $img) {
                            $path = $img['imgPath'];
                            echo "<img class='post-img' src='$path'/>";
                        }
                        echo "</div>";
                    }
                    echo "<p>$body</p>";
                ?>
            </div>
            <br>
            <?php
                echo "<div id='comment-line'>Comments ($commentCount)</div>";
                if($user != null){
                    echo "
                        <form id='new-comment' class='flex-row' method='POST' action='comment_handler.php'>
                            <input type='text' name='comment' placeholder='Add a comment'>
                            <input type='submit' value='post'>
                        </form>
                    ";
                }
            ?>
            <div id="comment-section" class="flex-col">
                <?php
                    foreach($comments as $comment) {
                        $commentID = $comment['id'];
                        $commentPoster = htmlspecialchars($comment['username']);
                        $commentBody = htmlspecialchars($comment['body']);
                        $delButton = ($user != null && ($user->isAdmin || $user->id == $comment['posterID']) ? 
                            "<button class='delete-comment' data-id='$commentID'><img src=trash-can.svg></button>" : "");
                        echo "
                            <div class='comment flex-row'>
                                <div class='expand'>
                                    <h3>$commentPoster</h3>
                                    <p>$commentBody</p>
                                </div>
                                $delButton
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="viewer.css">
    <script src="jquery-3.6.4.min.js"></script>
    <script src="viewer.min.js"></script>
    <script src="post.js"></script>
<?php require('footer.php'); ?>