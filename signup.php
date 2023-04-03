<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="squatchicon.png">
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
            <span class="expand"></span>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        </div>
        <div id="login-signup" class="flex-row">
            <form id="credentials" class="flex-col" method="POST" action="signup_handler.php">
                <h3>Signup</h3>
                <input type="text" name="username" placeholder="Display Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="retype" placeholder="Retype Password">
                <input type="submit" value="signup">
            </form>
        </div>
        <div id="footer-bar">
            ©2023 Spencer Mirly
        </div>
    </body>
</html>