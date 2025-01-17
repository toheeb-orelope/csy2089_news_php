<?php

//create an instance or object of a classs
$myImage = new \GenericClasses\DatabaseTable($pdo, 'images', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$categories = $categoryRecord->genFindAll();
$sidebar = $categoryRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Images';
$subTitle = '<h2>Images</h2>';

// $sidebar = require '../adminTemplates/sidebar.html.php';
if (isset($_SESSION['loggedin'])) {


    $images = $myImage->genFindAll();
    $display = $myImage->newsTemplate('../adminTemplates/viewimage.html.php', ['images' => $images]);

} else {

    $display = $myImage->newsTemplate('../adminTemplates/login.html.php', []);

}