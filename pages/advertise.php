<?php



//create an instance or object of a classs
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'categoryId');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$categories = $categoryRecord->genFindAll();

$pageTitle = 'Northampton News - Advert';
$subTitle = '<h2>Advertise with us</h2>';
$sidebar = $categoryRecord->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);



$articles = $articlesRecord->genFindAll();

$display = $articlesRecord->newsTemplate('../newsTemplates/advertise.html.php', []);

