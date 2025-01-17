<?php
//create an instance or object of a classs
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');


$categories = $categoryRecord->genFindAll();

$sidebar = $articlesRecord->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

$pageTitle = 'Published Articles';
// $subTitle = '<h2>Articles published by ' . $_GET['username'] . '</h2>';
$subTitle = '<h2>Articles published by <span style="font-weight: bold; color: blue;">' . htmlspecialchars($_GET['username']) . '</span></h2>';




// $articles = $articlesRecord->genFindAll();
$articles = [];
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $articles = $articlesRecord->genGetAll('username', $username);
    // var_dump($articles, $username);

}

// $display = $articlesRecord->newsTemplate('../adminTemplates/postby.html.php', ['articles' => $articles]);
$display = $categoryRecord->newsTemplate('../newsTemplates/postby.html.php', ['articles' => $articles]);
