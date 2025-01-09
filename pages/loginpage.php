<?php
/*

firstreader23    @FirstReader23
secondreader23    @SecondReader23
thirdreader23    @ThirdReader23

*/

// Create an instance of the DatabaseTable class
$myReader = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myComment = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');

$categories = $myCategory->genFindAll();
$sidebar = $myReader->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

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
