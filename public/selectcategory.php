<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'id');

$categories = $myCategory->genFindAll();
$articles = $myArticles->genGetAll('categoryId', $_GET['id']);

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);




$display = $myCategory->newsTemplate('../newsTemplates/selectcategory.htm.php', ['articles' => $articles]);



require '../newsTemplates/layout.html.php';


