<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <title>Sightsquatch</title>
    </head>
    <body>
        <div id="title-bar" class="flex-row">
            <img src="squatchicon.png">
            <h1 class="expand">Sightsquatch</h1>
        </div>
        <div id="nav-bar" class="flex-row">
            <a href="index.php">Home</a>
            <a href="sightings.php">Sightings</a>
            <a href="faq.php">FAQ</a>
            <a href="about.php">About</a>
            <span class="expand"></span>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        </div>
        <div id="login-signup" class="flex-row">
            <form id="create-post" class="flex-col">
                <h2>Post New Sighting</h2>
                <input type="text" name="title" placeholder="Title">
                <label for="pics">Images</label>
                <input type="file" name="img" accept="image/*" multiple>
                <label for="date">Sighting Date</label>
                <input type="date" name="date">
                <input type="text" name="body" placeholder="Post Body">
                <input type="submit" value="Create Post">
            </form>
        </div>
        <div id="footer-bar">
            ©2023 Spencer Mirly
        </div>
    </body>
</html>