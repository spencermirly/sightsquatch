<?php require('header.php'); ?>
    <div id="login-signup" class="flex-row">
        <form id="credentials" class="flex-col" method="POST" action="signup_handler.php">
            <h3>Signup</h3>
            <?php
                echo "<input type='text' name='username' placeholder='Display Name' value='" . (isset($_SESSION['form']) ? $_SESSION['form']['username'] : "") . "'>";
                echo "<input type='email' name='email' placeholder='Email' value='" . (isset($_SESSION['form']) ? $_SESSION['form']['email'] : "") . "'>";
                echo "<input type='password' name='password' placeholder='Password'>";
                echo "<input type='password' name='retype' placeholder='Retype Password'>";
                echo "<input type='submit' value='signup'>";
            ?>
        </form>
    </div>
<?php require('footer.php'); ?>