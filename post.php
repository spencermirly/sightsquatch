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
                    <h2>$title</h2>
                    <pre>$body</pre>
                ";
            ?>
        </div>
        <?php
            if($user != null){
                echo "
                    <div>
                        <form id='new-comment' class='flex-row' method='POST' action='comment_handler.php'>
                            <input type='text' name='comment' placeholder='Add a comment'>
                            <input type='submit' value='post'>
                        </form>
                    </div>
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