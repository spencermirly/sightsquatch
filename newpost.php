<?php require('header.php');
    if($user == null){
        header("Location: index.php");
        exit();
    }
?>
    <div id="login-signup" class="flex-row">
        <form id="create-post" class="flex-col" method="POST" action="newpost_handler.php">
            <h2>Post New Sighting</h2>
            <input type="text" name="title" placeholder="Title">
            <label for="pics">Images</label>
            <input type="file" name="img" accept="image/*" multiple>
            <label for="date">Sighting Date</label>
            <input type="date" name="date">
            <input type="text" name="location" placeholder="Sighting Location">
            <input type="text" name="body" placeholder="Post Body">
            <input type="submit" value="Create Post">
        </form>
    </div>
<?php require('footer.php'); ?>