<?php include 'Header.php';
include "Signup.php"; ?>

<div class='container text-center text-align-center form-signup mt-5'>
    <h1 class="mb-4 text-light">Sign up!</h1>
    <div class="row">
        <div class="col">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='post'>
                <div class="row field">
                    <input class="mb-1" type='text' name='name' placeholder='Name...'>

                    <input class="mb-1" type='text' name='email' placeholder='Email...'>

                    <input class="mb-1" type='text' name='uuid' placeholder='Username...'>

                    <input class="mb-1" type='password' name='pwd' placeholder='Password...'>

                    <input class="mb-2" type='password' name='pwdRetype' placeholder='Retype password...'><br>

                    <button class="signup-btn" type='submit'>Submit</button>
                </div>
            </form>
            <?php
            if (isset($_GET["error"])) {

                if ($_GET["error"] === "checkinputfields") {
                    echo "<p class='text-light mt-2'>Please check all input fields!</p>";
                } else if ($_GET["error"] === "nameerror") {
                    echo "<p class='text-light mt-2'>Only letters allowed in name!</p>";
                } else if ($_GET["error"] === "usernameerror") {
                    echo "<p class='text-light mt-2'>Only letters and numbers allowed!</p>";
                } else if ($_GET["error"] === "emailnotvalid") {
                    echo "<p class='text-light mt-2'>Email address not valid!</p>";
                } else if ($_GET["error"] === "invalidpwd") {
                    echo "<p class='text-light mt-2'>Only use letters and numbers</p>";
                } else if ($_GET["error"] === "passwordnotmatch") {
                    echo "<p class='text-light mt-2'>Passwords does not match!</p>";
                } else if ($_GET["error"] === "userExist") {
                    echo "<p class='text-light mt-2'>User already exist!</p>";
                }
            }
            if (isset($_GET["success"]) && $_GET["success"] === "usercreated") {
                echo "<p class='text-light mt-2'>User was created!</p>";
                echo "<a href='Index.php'>Login</a>";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>