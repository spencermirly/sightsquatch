<?php
    $page = "sightings";
    require('header.php');
    require_once('db.php');
    require_once('widgets.php');
?>
    <div id="content" class="flex-row expand">
        <form id="filters" class="flex-col" method="GET" action="sightings.php">
            <h2>Filter Sightings</h2>
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="Search">
        </form>
        <div id="recent" class="expand">
            <h2>Sightings</h2>
            <?php
                if($user != null){
                    echo "<a class='post flex-row' href='newpost.php'>Create New Post</a>";
                }
                $db = new DB();
                $res = $db->fetchPosts(100, $_GET['search'] ?? '');
                $res = array_reverse($res);
                foreach ($res as $post) {
                    echo Widgets::postEntryArr($post);
                }
            ?>
        </div>
    </div>
<?php require('footer.php'); ?>