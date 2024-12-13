<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'categoryId');
$myCategory = new Database($pdo, 'category', 'id');
$categories = $myCategory->genFindAll();

$pageTitle = 'Northampton News - Advert';
$subTitlte = 'Advertise with us';
var_dump($categories);


$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/advertise.html.php', []);


require '../newsTemplates/layout.html.php';