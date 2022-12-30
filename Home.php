<?php
session_start();
if (isset($_SESSION["uuid"])) {
    include "Header.php";
?>
    <h1>Home</h1>
    <a href="Logout.php">Logout</a>
<?php

    include "Footer.php";
} else {
    header("Location: Index.php");
    exit();
}
?>