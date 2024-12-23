<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';
require '../controllers/controller.php';


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
$pageTitle = 'Northampton News - Home';
$subTitle = '<h2>Northampton News</h2>';

$sidebar = newsTemplates(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);


$pageName = explode('?', ltrim($_SERVER['REQUEST_URI'], '/'))[0];
$page = $myController->$pageName();

$pageTitle = $page['pageTitle'];
$subTitle = $page['subTitle'];
$display = newsTemplates($page['fileName'], $page['variables']);



// if (isset($_GET['id'])) {
//     $articles = $myArticles->genFind('id', $_GET['id']);
// } else {
//     $article = null;
// }


// $display = $myCategory->newsTemplate('../newsTemplates/newshome.html.php', []);


require '../newsTemplates/layout.html.php';