<?php
class Controller
{
    function __construct(
        public $myArticles,
        public $myCategory,
        public $myComment,
        public $myReader,
        public $myAccount,
        public $myContact,
        public $myImage,
    ) {
    }


    public function adminhome()
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

            $users = $this->myArticles->genFind('username', $_POST['username']);


            if ($users && password_verify($_POST['password'], $users['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $users['username'];
                $_SESSION['id'] = $users['id'];
            } else {
                $display = $this->myArticles->newsTemplate('../adminTemplates/login.html.php', []);
            }



            if (isset($_SESSION['loggedin'])) {
                $users = $this->myArticles->genFind('username', $_POST['username']);
                $display = $this->myArticles->newsTemplate(
                    '../adminTemplates/adminHome.html.php',
                    ['users' => $users]
                );
            }

        } else {
            $display = $this->myArticles->newsTemplate('../adminTemplates/login.html.php', []);
        }

        return [
            'pageTitle' => $pageTitle,
            'subTitle' => $subTitle,
            'fileName' => $display,
            'variables' => [],
        ];
    }
}