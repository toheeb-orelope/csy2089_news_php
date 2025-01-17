<?php

//create an instance or object of a classs
$myUsers = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'id');
$myStatus = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'status');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$categories = $categoryRecord->genFindAll();
$sidebar = $categoryRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);

/*
usernames           passwords
firstUser24         MyPassword12@
secondUser24        StrongPass123!
anotheruser24       Admin24!
Taofeeq2024         @Taofeeq2024!
*/
$status = [];
$status = $myStatus->getEnumValues();

$pageTitle = 'Northampton News - Users';
$subTitle = '<h2>Admin Dashboard</h2>';

// $sidebar = require '../adminTemplates/sidebar.html.php';
if (isset($_SESSION['loggedin'])) {

    $action = $_GET['action'] ?? null;
    //Add user implementation
    if (isset($_POST['submit'])) {

        if (!empty($_POST['accounts']['username']) && !empty($_POST['accounts']['password'])) {

            $hPassword = $_POST['accounts']['password'];
            $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
            $_POST['accounts']['password'] = $hashPassword;
            $myUsers->genSave($_POST['accounts']);
            header('location: viewusers.php');

        } else {
            echo 'Please fill in required field to create an account';
        }


    } else {
        $user = null;
        if ($action === 'edit' && isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id) {
                $user = $myUsers->genFind('id', $id);
            }
        }
    }

    if ($action === 'delete' && isset($_GET['id'])) {
        $myDelete = $myUsers->genFind('id', $_GET['id']);
        if ($myDelete['status'] == 'Admin') {
            $myUsers->redirectWithMessage(
                'Admin can not be deleted',
                'bad',
                '../admin/viewusers.php'
            );
            exit;
        } else {
            $myUsers->genDelete('id', $_GET['id']);
            $myUsers->redirectWithMessage(
                'User deleted',
                'success',
                '../admin/viewusers.php'
            );
        }
    }

    $users = $myUsers->genFindAll();
    $display = $myUsers->newsTemplate(
        '../adminTemplates/viewusers.html.php',
        [
            'users' => $users,
            'account' => $user,
            'status' => $status
        ]

    );


} else {

    $display = $myUsers->newsTemplate('../adminTemplates/login.html.php', []);

}