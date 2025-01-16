<?php


/*
usernames           passwords
firstUser24         MyPassword12@
secondUser24        StrongPass123!
anotheruser24       Admin24!
Taofeeq2024         @Taofeeq2024!
*/

if (isset($_POST['submit'])) {
    // session_start();
//create an instance or object of a classs
    $myArticles = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'id');
    $myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
    $categories = $myCategory->genFindAll();
    $sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);



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
            echo 'Username and password do not match.😒😒😒 <a href="index.php"> Please try again </a>';
            // header('location: index.php');
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