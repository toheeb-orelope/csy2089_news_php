<?php
/*

firstreader23    @FirstReader23
secondreader23    @SecondReader23
thirdreader23    @ThirdReader23

*/

$subTitle = '<h2>Login</h2>';
$pageTitle = 'Northampton News - Login';

if (isset($_POST['submit'])) {
    // session_start();

    $users = $myReader->genFind('username', $_POST['username']);


    if ($users && password_verify($_POST['password'], $users['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $users['username'];
        $_SESSION['id'] = $users['id'];
        $display = $myReader->newsTemplate('../newsTemplates/newshome.html.php', ['users' => $users]);
    } else {
        header('location: loginpage.php');
    }
    
} else {
    $display = $myReader->newsTemplate('../newsTemplates/login.html.php', []);
}
