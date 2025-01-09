<?php

namespace IJDB\Controllers;

class Account
{
    public function __construct(
        public $myUsers,
        public $myCategory,
        public $myStatus,
    ) {
    }

    public function users()
    {
        /*
        usernames           passwords
        firstUser24         MyPassword12@
        secondUser24        StrongPass123!
        anotheruser24       Admin24!
        Taofeeq2024         @Taofeeq2024!
        */
        $categories = $this->myCategory->genFindAll();

        $status = $this->myStatus->getEnumValues();

        $pageTitle = 'Northampton News - Users';
        $subTitle = '<h2>Admin Dashboard</h2>';

        if (isset($_SESSION['loggedin'])) {
            $action = $_GET['action'] ?? null;
            $user = null;

            if ($action === 'edit' && isset($_GET['id'])) {
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($id) {
                    $user = $this->myUsers->genFind('id', $id);
                }
            }

            if ($action === 'delete' && isset($_GET['id'])) {
                $myDelete = $this->myUsers->genFind('id', $_GET['id']);
                if ($myDelete['status'] == 'Admin') {
                    $_SESSION['message'] = 'Admin cannot be deleted';
                    $_SESSION['messageType'] = 'bad';
                    $_SESSION['redirect_url'] = '/account/users';
                    header('location: /account/message');
                    exit;
                } else {
                    $this->myUsers->genDelete('id', $_GET['id']);
                    $_SESSION['message'] = 'User deleted successfully';
                    $_SESSION['messageType'] = 'success';
                    $_SESSION['redirect_url'] = '/account/users';
                    header('location: /account/message');
                    exit;
                }
            }

            if (isset($_POST['submit'])) {
                if (!empty($_POST['accounts']['username']) && !empty($_POST['accounts']['password'])) {
                    $hPassword = $_POST['accounts']['password'];
                    $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
                    $_POST['accounts']['password'] = $hashPassword;
                    $this->myUsers->genSave($_POST['accounts']);
                    header('location: /account/users');
                } else {
                    echo 'Please fill in required fields to create an account';
                }
            }

            $users = $this->myUsers->genFindAll();
            return [
                'fileName' => '../adminTemplates/viewusers.html.php',
                'variables' => ['users' => $users, 'account' => $user, 'status' => $status],
                'pageTitle' => 'Users',
                'subTitle' => '<h2>Staff Board</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Login',
                'subTitle' => '<h2>Login</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }

    public function message()
    {
        $message = $_SESSION['message'] ?? 'An unknown error occurred.';
        $messageType = $_SESSION['messageType'] ?? 'error';
        $redirectUrl = $_SESSION['redirect_url'] ?? null;


        unset($_SESSION['message'], $_SESSION['redirect_url'], $_SESSION['messageType']);

        return [
            'fileName' => '../adminTemplates/messages.html.php',
            'variables' => [
                'message' => $message,
                'messageType' => $messageType,
                'redirectUrl' => $redirectUrl
            ],
            'pageTitle' => 'Message',
            'subTitle' => '<h2>Message</h2>',
            'sidebar' => '../adminTemplates/sidebar.html.php',
        ];
    }


    public function logout()
    {

        session_destroy();
        header('location: /admin/home');

    }
}