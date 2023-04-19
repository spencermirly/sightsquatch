<?php
    $page = "login";
    require('header.php');
?>
    <div id="login-signup" class="flex-row">
        <form id="credentials" class="flex-col" method="POST" action="login_handler.php">
            <h3>Login</h3>
            <div class="flex-row form-cols">
                <div class="flex-col">
                    <label for="email">Email</label>
                    <label for="password">Password</label>
                </div>
                <div class="flex-col expand">
                    <input type="email" id="email" name="email" placeholder="Enter Email" class="expand" value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['email'] : ""); ?>'>
                    <input type="password" id="password" name="password" class="expand" placeholder="Password">
                </div>
            </div>
            <input type="submit" value="login">
        </form>
    </div>
<?php require('footer.php'); ?>