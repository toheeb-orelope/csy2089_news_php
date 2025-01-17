<?php
namespace IJDB\Controllers;
class News
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
        return [
            'sidebar' => '../newsTemplates/newssibebar.html.php',
            'fileName' => '../newsTemplates/newshome.html.php',
            'variables' => [],
            'pageTitle' => 'Home',
            'subTitle' => '<h2>Northampton News</h2>',
        ];
    }

    public function advertise()
    {

        return [
            'fileName' => '../newsTemplates/advertise.html.php',
            'variables' => [],
            'pageTitle' => 'Advert',
            'subTitle' => '<h2>Advertise with us</h2>',
            'sidebar' => '../newsTemplates/newssibebar.html.php',
        ];
    }

    public function contact()
    {
        if (isset($_GET['id'])) {
            $contact = $this->contactRecord->genFind('id', $_GET['id']);
        } else {
            $contact = false;
        }

        if (isset($_POST['submit'])) {
            $this->contactRecord->genSave($_POST['contact']);
            header('location: /contact');
        } else {
            return [
                'fileName' => '../newsTemplates/contacts.html.php',
                'variables' => ['contact' => $contact],
                'pageTitle' => 'Contact Us',
                'subTitle' => '<h2>Contact Us</h2>',
                'sidebar' => '../newsTemplates/newssibebar.html.php',
            ];
        }
    }

    public function latest()
    {
        $articles = $this->articlesRecord->findByOrder();

        return [
            'fileName' => '../newsTemplates/latest.html.php',
            'variables' => ['articles' => $articles],
            'pageTitle' => 'Latest News',
            'subTitle' => '<h2>Latest News</h2>',
            'sidebar' => '../newsTemplates/newssibebar.html.php',
        ];
    }

    public function selectcategory()
    {
        $articles = $this->articlesRecord->genGetAll('categoryId', $_GET['id']);
        return [
            'fileName' => '../newsTemplates/selectcategory.html.php',
            'variables' => ['articles' => $articles],
            'pageTitle' => 'Select Category',
            'subTitle' => '<h2>Select Category</h2>',
            'sidebar' => '../newsTemplates/newssibebar.html.php',
        ];
    }

    public function articledetail()
    {
        $action = $_GET['action'] ?? null;

        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];
            $article = $this->articlesRecord->genFind('id', $articleId);
            $comments = $this->commentRecord->genGetAll('articleId', $articleId);
        } else {
            $article = null;
            $comments = [];
        }

        if (isset($action) && $action === 'delete') {
            $this->commentRecord->genDelete('id', $_GET['id']);
        }

        if (isset($action) && $action === 'edit') {
            $comment = $this->commentRecord->genFind('id', $_GET['id']);
        } else {
            $comment = null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendcomment'])) {
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $username = $_SESSION['username'];
                $postComments = $_POST['comment'];
                $postComments['articleId'] = $articleId;
                $postComments['username'] = $username;

                if (empty($postComments['id'])) {
                    unset($postComments['id']);
                }

                $this->commentRecord->genSave($postComments);
                // header("Location: articledetail.php?id=$articleId");
                // exit;
            } else {
                header("Location: ../newsTemplates/login.html.php?redirect=/news/articledetail?id=$articleId");
                exit;
            }
        }
        return [
            'fileName' => '../newsTemplates/articledetail.html.php',
            'variables' => [
                'article' => $article,
                'comments' => $comments,
                'comment' => $comment
            ],
            'pageTitle' => 'Article Detail',
            'subTitle' => '<h2>Article Detail</h2>',
            'sidebar' => '../newsTemplates/newssibebar.html.php',
        ];
    }


    public function postby()
    {
        $articles = [];
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $articles = $this->articlesRecord->genGetAll('username', $username);
        }
        return [
            'fileName' => '../newsTemplates/postby.html.php',
            'variables' => ['articles' => $articles],
            'pageTitle' => 'Published Articles',
            'subTitle' => '<h2>Articles published by <span style="font-weight: bold; color: blue;">'
                . htmlspecialchars($_GET['username']) . '</span></h2>',
            'sidebar' => '../newsTemplates/newssibebar.html.php',
        ];
    }


    public function loginpage()
    {
        /*
        firstreader23    @FirstReader23
        secondreader23    @SecondReader23
        thirdreader23    @ThirdReader23
        lastreader23    @LastReader23
        */
        if (isset($_POST['submit'])) {

            $users = $this->readersRecord->genFind('username', $_POST['username']);

            if ($users && password_verify($_POST['password'], $users['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $users['username'];
                $_SESSION['id'] = $users['id'];
                header('location: /news/home');
            }
            return [
                'fileName' => '../newsTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Login',
                'subTitle' => '<h2>Login</h2>',
                'sidebar' => '../newsTemplates/newssibebar.html.php',
            ];
        } else {

            return [
                'fileName' => '../newsTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Login',
                'subTitle' => '<h2>Login</h2>',
                'sidebar' => '../newsTemplates/newssibebar.html.php',
            ];
        }
    }

    public function profile()
    {
        /*
        firstreader23    @FirstReader23
        secondreader23    @SecondReader23
        thirdreader23    @ThirdReader23
        lastreader23    @LastReader23
        */
        if (isset($_POST['submit'])) {

            if (!empty($_POST['profile']['username']) && !empty($_POST['profile']['password'])) {
                $hPassword = $_POST['profile']['password'];
                $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
                $_POST['profile']['password'] = $hashPassword;

                $this->readersRecord->genSave($_POST['profile']);

                header('location: loginpage');
                exit;
            } else {
                echo 'Please fill in required fields to create an account';
            }
        } else {
            $profile = null;
            if (isset($_GET['id'])) {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($id) {
                    $profile = $this->readersRecord->genFind('id', $id);
                }
            }

            return [
                'fileName' => '../newsTemplates/profile.html.php',
                'variables' => [],
                'pageTitle' => 'Profile',
                'subTitle' => '<h2>Create Account</h2>',
                'sidebar' => '../newsTemplates/newssibebar.html.php',
            ];
        }
    }


    public function logout()
    {

        session_destroy();
        header('location: /news/home');

    }
}