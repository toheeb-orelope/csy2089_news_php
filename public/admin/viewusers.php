<?php
session_start();

require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myUsers = new Database($pdo, 'accounts', 'id');
$myCategory = new Database($pdo, 'category', 'id');
$categories = $myCategory->genFindAll();
$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);


$pageTitle = 'Northampton News - Users';
$subTitlte = 'Staffs';

// $sidebar = require '../adminTemplates/sidebar.html.php';
if (isset($_SESSION['loggedin'])) {


    $users = $myUsers->genFindAll();
    $display = $myUsers->newsTemplate('../adminTemplates/viewusers.html.php', ['users' => $users]);

} else {

    $display = $myUsers->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';
