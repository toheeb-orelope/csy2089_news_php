<?php
$sidebar = $myArticles->newsTemplate(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);

//create an instance or object of a classs
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');

$pageTitle = 'Article';
$subTitle = '<h2>Article</h2>';


$categories = $myCategory->genFindAll();
$articles = $myArticles->genGetAll('categoryId', $_GET['id']);







$display = $myCategory->newsTemplate(
    '../newsTemplates/selectcategory.htm.php',
    ['articles' => $articles]
);