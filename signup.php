<?php require('header.php'); ?>
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
<?php require('footer.php'); ?>