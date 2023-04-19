<?php
    $page = "signup";
    require('header.php');
?>
    <div id="login-signup" class="flex-row">
        <form id="credentials" class="flex-col" method="POST" action="signup_handler.php">
            <h3>Signup</h3>
            <div class="flex-row form-cols">
                <div class="flex-col">
                    <label for='username'>Display Name</label>
                    <label for='email'>Email</label>
                    <label for='password'>Password</label>
                    <label for='retype'>Retype Password</label>
                </div>
                <div class="flex-col expand">
                    <input type='text' id='username' name='username' placeholder='Display Name' value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['username'] : "");?>'>
                    <input type='email' id='email' name='email' placeholder='Email' value='<?php echo (isset($_SESSION['form']) ? $_SESSION['form']['email'] : ""); ?>'>
                    <input type='password' id='password' name='password' placeholder='Password'>
                    <input type='password' id='retype' name='retype' placeholder='Retype Password'>
                </div>
            </div>
            <input type='submit' value='signup'>
        </form>
    </div>
<?php require('footer.php'); ?>