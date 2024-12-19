<?php
session_start();

require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myUsers = new Database($pdo, 'accounts', 'id');
$myStatus = new Database($pdo, 'accounts', 'status');
$myCategory = new Database($pdo, 'category', 'id');
$categories = $myCategory->genFindAll();
$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);

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
$subTitlte = 'Staffs';

// $sidebar = require '../adminTemplates/sidebar.html.php';
if (isset($_SESSION['loggedin'])) {


    //Add user implementation
    if (isset($_POST['submit'])) {

        if (!empty($_POST['accounts']['username']) && !empty($_POST['accounts']['password'])) {

            $hPassword = $_POST['accounts']['password'];
            $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
            $_POST['accounts']['password'] = $hashPassword;
            $myUsers->genSave($_POST['accounts']);
            // $display = 'Accound created!!! <a href="index.php"> click here to login </a>';
            header('location: viewusers.php');

        } else {
            echo 'Please fill in required field to create an account';
        }


    } else {
        $user = null;
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id) {
                $user = $myUsers->genFind('id', $id);
            }
        }
    }

    if (isset($_GET['id'])) {
        $myDelete = $myUsers->genFind('id', $_GET['id']);
        if ($myDelete['status'] == 'Admin') {
            $myUsers->redirectWithMessage(
                'Admin can not be deleted',
                'bad',
                '../admin/messages.php'
            );
            exit;
        } else {
            $myUsers->genDelete('id', $_GET['id']);
            $myUsers->redirectWithMessage(
                'User deleted',
                'success',
                '../admin/messages.php'
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

require '../../newsTemplates/layout.html.php';
