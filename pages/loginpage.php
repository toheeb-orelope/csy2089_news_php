<?php
/*

firstreader23    @FirstReader23
secondreader23    @SecondReader23
thirdreader23    @ThirdReader23

*/

// Create an instance of the DatabaseTable class
$readersRecord = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$commentRecord = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');

$categories = $categoryRecord->genFindAll();
$sidebar = $readersRecord->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

if (isset($_POST['submit'])) {
    // session_start();

    $users = $readersRecord->genFind('username', $_POST['username']);


    if ($users && password_verify($_POST['password'], $users['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $users['username'];
        $_SESSION['id'] = $users['id'];
        $display = $readersRecord->newsTemplate('../newsTemplates/newshome.html.php', ['users' => $users]);
    } else {
        header('location: loginpage.php');
    }
} else {
    $display = $readersRecord->newsTemplate('../newsTemplates/login.html.php', []);
}
