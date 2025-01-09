<?php



//create an instance or object of a classs
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'categoryId');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$categories = $myCategory->genFindAll();

$pageTitle = 'Northampton News - Advert';
$subTitle = '<h2>Advertise with us</h2>';
$sidebar = $myCategory->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);



$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/advertise.html.php', []);

