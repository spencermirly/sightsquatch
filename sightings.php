<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <title>Sightsquatch</title>
    </head>
    <body>
        <div id="title-bar" class="flex-row">
            <img src="squatchicon.png">
            <h1  class="expand">Sightsquatch</h1>
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
        <div id="content" class="flex-row expand">
            <form id="filters" class="flex-col">
                <h2>Filter Sightings</h2>
                <input type="text" name="search" placeholder="Search">
                <label for="start">Start Date</label>
                <input type="date" name="start">
                <label for="end">End Date</label>
                <input type="date" name="end">
                <input type="submit" value="Search">
            </form>
            <div id="recent" class="expand">
                <h2>Sightings</h2>
                <a class="post flex-row" href="newpost.php">Create New Post</a>
                <div class="post flex-row">
                    <div class="info expand">
                    <h3>Example Post</h3>
                        <div class="metadata flex-row">
                            <span class="name">Example User</span>
                            <span class="expand"></span>
                            <span class="loc">Boise, ID</span>
                            <span class="date">1/27/2023</span>
                        </div>
                    </div>
                    <div class="comment-count flex-col">
                        <img src=chat-left-text-fill.svg>
                        <span><strong>12</strong></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer-bar">
            ©2023 Spencer Mirly
        </div>
    </body>
</html>