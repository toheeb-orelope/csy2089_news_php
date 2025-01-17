<?php
$sidebar = $articlesRecord->newsTemplate(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);

//create an instance or object of a classs
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');

$pageTitle = 'Article';
$subTitle = '<h2>Article</h2>';


$categories = $categoryRecord->genFindAll();
$articles = $articlesRecord->genGetAll('categoryId', $_GET['id']);







$display = $categoryRecord->newsTemplate(
    '../newsTemplates/selectcategory.htm.php',
    ['articles' => $articles]
);