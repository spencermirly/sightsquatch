<?php
    require('header.php');
    require_once('widgets.php');
    require_once('db.php');
?>
    <img id="main-img" src="Forest.jpeg">
    <div id="content" class="flex-row">
        <div id="news" class="expand">
            <h2>News</h2>
            <ul>
                <li>Bigfoot sightings increasing in recent months</li>
                <li>New evidence for bigfoot's existence?</li>
                <li>Recent study shows that belief in bigfoot is lower among millenials</li>
            </ul>
        </div>
        <div id="recent" class="expand">
            <h2>Recent Sightings</h2>
            <?php
                $db = new DB();
                $res = $db->fetchPosts(10);
                foreach ($res as $post) {
                    echo Widgets::postEntryArr($post);
                }
            ?>
        </div>
    </div>
<?php require('footer.php'); ?>