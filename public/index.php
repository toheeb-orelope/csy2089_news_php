<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../GenericClasses/database.php';
require '../IJDB/Controllers/controller.php';

//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'categoryId');
$myComment = new Database($pdo, 'comments', 'id');
$myReader = new Database($pdo, 'reader', 'id');
$myAccount = new Database($pdo, 'accounts', 'id');
$myContact = new Database($pdo, 'contactus', 'id');
$myImage = new Database($pdo, 'images', 'id');
$myController = new Controller(
    $myArticles,
    $myCategory,
    $myComment,
    $myReader,
    $myAccount,
    $myContact,
    $myImage
);


$categories = $myCategory->genFindAll();

$sidebar = newsTemplates(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);


$pageName = explode('?', ltrim($_SERVER['REQUEST_URI'], '/'))[0];
$page = $myController->$pageName();

$pageTitle = $page['pageTitle'];
$subTitle = $page['subTitle'];
$display = newsTemplates($page['fileName'], $page['variables']);



require '../newsTemplates/layout.html.php';