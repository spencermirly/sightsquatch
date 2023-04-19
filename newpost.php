<?php
    $page = "newpost";
    require('header.php');
    if($user == null){
        header("Location: index.php");
        exit();
    }
?>
    <div id="login-signup" class="flex-row">
        <form id="create-post" class="flex-col" method="POST" action="newpost_handler.php" enctype="multipart/form-data">
            <h2>Post New Sighting</h2>
            <div class="flex-row form-cols">
                <div class="flex-col">
                    <label for="title">Title</label>
                    <label for="images">Images</label>
                    <label for="date">Sighting Date</label>
                    <label for="location">Sighting Location</label>
                    <label for="body">Post Body</label>
                </div>
                <div class="flex-col expand">
                    <input type="text" id="title" name="title" placeholder="Title" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['title'] : ""); ?>'>
                    <input type="file" id="images" name="img[]" accept="image/*" multiple="multiple">
                    <input type="date" id="date" name="date" value='<?php (isset($_SESSION['form']) ? $_SESSION['form']['date'] : "") ?>'>
                    <input type="text" id="location" name="location" placeholder="Sighting Location" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['location'] : ""); ?>'>
                    <input type="text" id="body" name="body" placeholder="Post Body" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['body'] : ""); ?>'>
                </div>
            </div>
            
            <input type="submit" value="Create Post">
        </form>
    </div>
<?php require('footer.php'); ?>