<?php
session_start();

require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myImage = new Database($pdo, 'images', 'id');
$myCategory = new Database($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();
$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Images';
$subTitlte = 'Images';

// $sidebar = require '../adminTemplates/sidebar.html.php';
if (isset($_SESSION['loggedin'])) {


    $images = $myImage->genFindAll();
    $display = $myImage->newsTemplate('../adminTemplates/viewimage.html.php', ['images' => $images]);

} else {

    $display = $myImage->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';
