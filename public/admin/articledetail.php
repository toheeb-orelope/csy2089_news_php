<?php
session_start();
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

// Create an instance of the Database class
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();
$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Article';
$subTitle = 'Article';

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['id'])) {
        // Fetch the article by ID
        $article = $myArticles->genFind('id', $_GET['id']);
    } else {
        $article = null; // Handle case where no ID is provided
    }

    $display = $myArticles->newsTemplate('../adminTemplates/articledetail.html.php', ['article' => $article]);
} else {
    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);
}

require '../../newsTemplates/layout.html.php';