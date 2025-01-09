<?php

namespace Ijdb\Controllers;

class Admin
{
    function __construct(
        public $myArticles,
        public $myCategory,
        public $myComment,
        public $myReader,
        public $myAccount,
        public $myContact,
    ) {
    }

    public function home()
    {
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

            $users = $this->myAccount->genFind('username', $_POST['username']);

            if ($users && password_verify($_POST['password'], $users['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $users['username'];
                $_SESSION['id'] = $users['id'];
            } else {
                echo 'Username and password do not match.😒😒😒 <a href="index.php"> Please try again </a>';
                // header('location: index.php');
            }



            if (isset($_SESSION['loggedin'])) {
                $users = $this->myAccount->genFind('username', $_POST['username']);
                return [
                    'fileName' => '../adminTemplates/adminHome.html.php',
                    'variables' => ['users' => $users],
                    'pageTitle' => $pageTitle,
                    'subTitle' => $subTitle,
                    'sidebar' => '../adminTemplates/sidebar.html.php',
                ];
            }

        } else {
            $this->myAccount->newsTemplate('../adminTemplates/login.html.php', []);
        }

        return [
            'fileName' => '../adminTemplates/login.html.php',
            'variables' => [],
            'pageTitle' => $pageTitle,
            'subTitle' => $subTitle,
            'sidebar' => '../adminTemplates/sidebar.html.php',
        ];
    }
}
