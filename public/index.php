<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'categoryId');

$categories = $myCategory->genFindAll();
$pageTitle = 'Northampton News - Home';

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

if (isset($_GET['id'])) {
    $articles = $myArticles->genFind('id', $_GET['id']);
} else {
    $article = null;
}


$pageTitle = 'Northampton News - Home';
$subTitle = '<h2>Northampton News</h2>';



$display = $myCategory->newsTemplate('../newsTemplates/newshome.html.php', []);


require '../newsTemplates/layout.html.php';