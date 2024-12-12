<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'id');

$categories = $myCategory->genFindAll();
$articles = $myArticles->genFindAll();

$categories = ['categories' => $categories];
$articles = ['articles' => $articles];

$display = $myCategory->newsTemplate('../newsTemplates/selectcategory.htm.php', $categories);
$display = $myArticles->newsTemplate('../newsTemplates/selectcategory.htm.php', $articles);


require '../newsTemplates/newslayout.html.php';

