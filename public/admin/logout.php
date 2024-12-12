<?php
session_start();
unset($_SESSION['loggedin']);
echo 'You are now logged out
<a href="index.php">Login</a>';