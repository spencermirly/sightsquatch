<?php
    require('header.php');
    require_once('db.php');
    require_once('widgets.php');
    
    if(!isset($_GET['post_id'])){
        header("Location: sightings.php");
        exit();
    }

    $db = new DB();
    $post = $db->fetchPost($_GET['post_id']);

    $title = htmlspecialchars($post['title']);
    $body = htmlspecialchars($post['body']);
    $poster = htmlspecialchars($post['username']);
    $location = htmlspecialchars($post['sightingLoc']);
    $date = htmlspecialchars($post['sightingDate']);
    $commentCount = htmlspecialchars($post['comments']);

    $comments = $db->fetchComments($_GET['post_id']);
    $_SESSION['current_post'] = $_GET['post_id'];
?>
    <div id="content" class="flex-col expand">
        <div id="post-section">
            <?php
                echo "
                    <div id='title'section' class='flex-row'>
                        <h2 class='expand'>$title</h2>
                        <button style='width: 50px; padding: 0;'><img src=trash-can.svg></button>
                    </div>
                ";
                $images = $db->fetchImages($_GET['post_id']);
                if(!empty($images)){
                    echo "<div id='img-section' class='flex-row'>";
                    foreach($images as $img) {
                        $path = $img['imgPath'];
                        echo "<img src='$path'/>";
                    }
                    echo "</div>";
                }
                echo "<p>$body</p>";
            ?>
        </div>
        <br>
        <?php
            if($user != null){
                echo "
                    <form id='new-comment' class='flex-row' method='POST' action='comment_handler.php'>
                        <input type='text' name='comment' placeholder='Add a comment'>
                        <input type='submit' value='post'>
                    </form>
                ";
            }
        ?>
        <div id="comment-section">
            <?php
                foreach($comments as $comment) {
                    $commentPoster = htmlspecialchars($comment['username']);
                    $commentBody = htmlspecialchars($comment['body']);
                    echo "
                        <div class='comment'>
                            <h3>$commentPoster</h3>
                            <pre>$commentBody</pre>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
<?php require('footer.php'); ?>