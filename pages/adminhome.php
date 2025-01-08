<?php
$pageTitle = 'Home';
$subTitle = '<h2>Admin Home</h2>';

/*
usernames           passwords
firstUser24         MyPassword12@
secondUser24        StrongPass123!
anotheruser24       Admin24!
Taofeeq2024         @Taofeeq2024!
*/

if (isset($_POST['submit'])) {
    // session_start();

    $users = $myArticles->genFind('username', $_POST['username']);


    if ($users && password_verify($_POST['password'], $users['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $users['username'];
        $_SESSION['id'] = $users['id'];
    } else {
        $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);
    }



    if (isset($_SESSION['loggedin'])) {
        $users = $myArticles->genFind('username', $_POST['username']);
        $display = $myArticles->newsTemplate(
            '../adminTemplates/adminHome.html.php',
            ['users' => $users]
        );
    }

} else {
    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);
}