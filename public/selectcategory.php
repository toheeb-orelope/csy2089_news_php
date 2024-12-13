<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'id');

$categories = $myCategory->genFindAll();
$articles = $myArticles->genGetAll('categoryId', $_GET['id']);

$pageTitle = 'Northampton News - View';
$subTitlte = 'All';

$display = $myArticles->newsTemplate(
    '../newsTemplates/selectcategory.htm.php',
    ['articles' => $articles]
);


require '../newsTemplates/layout.html.php';

