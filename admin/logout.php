<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    unset($_SESSION['loggedin']);
    unset($_SESSION['username']);
}
session_destroy();
header("Location: login.php");
exit;
?>