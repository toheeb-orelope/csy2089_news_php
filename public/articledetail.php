<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';

// Create an instance of the Database class
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();
$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

$pageTitle = 'Article';
$subTitle = 'Article';


if (isset($_GET['id'])) {

    $article = $myArticles->genFind('id', $_GET['id']);
} else {
    $article = null;
}

// $display = $myArticles->newsTemplate('../adminTemplates/articledetail.html.php', ['article' => $article]);
$display = $myCategory->newsTemplate('../newsTemplates/articledetail.html.php', ['article' => $article]);


require '../newsTemplates/layout.html.php';