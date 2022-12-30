<?php include "Login.php"; ?>
<div class="signin-form">
    <h1>Sign in!</h1>
    <div class="row">
        <div class="row">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row field">
                    <input class="mb-2 mt-2" type="text" name="uuid" placeholder="Username...">
                    <input class="mb-2" type="password" name="pwd" placeholder="Password...">
                    <button class="signin-btn" type="submit">Submit</button>
                </div>
            </form>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] === "usernotexist") {
                    echo "<p class='text-light mt-2'>User does not exist</p>";
                }
            }
            ?>
            <div class="mt-1">
                <a class="link" href="signup_form.php">Register</a>
            </div>
        </div>
    </div>
</div>