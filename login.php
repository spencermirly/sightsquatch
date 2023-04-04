<?php require('header.php'); ?>
    <div id="login-signup" class="flex-row">
        <form id="credentials" class="flex-col" method="POST" action="login_handler.php">
            <h3>Login</h3>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="login">
        </form>
    </div>
<?php require('footer.php'); ?>