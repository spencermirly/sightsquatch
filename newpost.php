<?php require('header.php');
    if($user == null){
        header("Location: index.php");
        exit();
    }
?>
    <div id="login-signup" class="flex-row">
        <form id="create-post" class="flex-col" method="POST" action="newpost_handler.php" enctype="multipart/form-data">
            <h2>Post New Sighting</h2>
            <input type="text" name="title" placeholder="Title" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['title'] : ""); ?>'>
            <label for="pics">Images</label>
            <input type="file" name="img[]" accept="image/*" multiple="multiple">
            <label for="date">Sighting Date</label>
            <input type="date" name="date" value='<?php (isset($_SESSION['form']) ? $_SESSION['form']['date'] : "") ?>'>
            <input type="text" name="location" placeholder="Sighting Location" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['location'] : ""); ?>'>
            <input type="text" name="body" placeholder="Post Body" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['body'] : ""); ?>'>
            <input type="submit" value="Create Post">
        </form>
    </div>
<?php require('footer.php'); ?>