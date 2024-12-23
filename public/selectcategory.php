<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';

$sidebar = $myArticles->newsTemplate(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);

//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'id');

$pageTitle = 'Article';
$subTitle = '<h2>Article</h2>';


$categories = $myCategory->genFindAll();
$articles = $myArticles->genGetAll('categoryId', $_GET['id']);






$display = $myCategory->newsTemplate(
    '../newsTemplates/selectcategory.htm.php',
    ['articles' => $articles]
);



require '../newsTemplates/layout.html.php';


