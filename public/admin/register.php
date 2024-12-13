<?php

require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myUsers = new Database($pdo, 'accounts', 'id');
$myStatus = new Database($pdo, 'accounts', 'status');

$myCategory = new Database($pdo, 'category', 'id');
$categories = $myCategory->genFindAll();
$pageTitle = 'Create Account - Account';
$sidebar = $myStatus->newsTemplate('../adminTemplates/sidebar.html.php', []);


/*
usernames           passwords
firstUser24         MyPassword12@
secondUser24        StrongPass123!
anotheruser24       Admin24!
*/

$status = [];
$status = $myStatus->getEnumValues();


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

    $display = $myUsers->newsTemplate('../adminTemplates/register.html.php', ['account' => $user, 'status' => $status]);
}


require '../../newsTemplates/layout.html.php';