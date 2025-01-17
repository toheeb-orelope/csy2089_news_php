<?php

namespace Ijdb\Controllers;

class Admin
{
    function __construct(
        public $articlesRecord,
        public $categoryRecord,
        public $commentRecord,
        public $readersRecord,
        public $accountRecord,
        public $contactRecord,
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

            $users = $this->accountRecord->genFind('username', $_POST['username']);

            if ($users && password_verify($_POST['password'], $users['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $users['username'];
                $_SESSION['id'] = $users['id'];
            } else {
                return [
                    'fileName' => '../adminTemplates/error.html.php',
                    'variables' => [],
                    'pageTitle' => $pageTitle,
                    'subTitle' => $subTitle,
                    'sidebar' => '../adminTemplates/sidebar.html.php',
                ];
            }



            if (isset($_SESSION['loggedin'])) {
                $users = $this->accountRecord->genFind('username', $_POST['username']);
                return [
                    'fileName' => '../adminTemplates/adminHome.html.php',
                    'variables' => ['users' => $users],
                    'pageTitle' => $pageTitle,
                    'subTitle' => '<h2>Admin Home</h2>',
                    'sidebar' => '../adminTemplates/sidebar.html.php',
                ];
            }

        } else {
            $this->accountRecord->newsTemplate('../adminTemplates/login.html.php', []);
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
