<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';

//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');


$categories = $myCategory->genFindAll();

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

$pageTitle = 'Home';
$subTitlte = 'Articles published by ' . $_GET['username'];


// $articles = $myArticles->genFindAll();
$articles = [];
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $articles = $myArticles->genGetAll('username', $username);
    var_dump($articles, $username);

}

// $display = $myArticles->newsTemplate('../adminTemplates/postby.html.php', ['articles' => $articles]);
$display = $myCategory->newsTemplate('../newsTemplates/postby.html.php', ['articles' => $articles]);



require '../newsTemplates/layout.html.php';