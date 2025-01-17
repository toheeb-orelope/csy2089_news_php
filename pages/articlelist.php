<?php


$categories = $categoryRecord->genFindAll();

$sidebar = $articlesRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Home';
$subTitle = '<h2>Articles</h2>';
if (isset($_SESSION['loggedin'])) {


    $articles = $articlesRecord->genFindAll();
    // $articles = [];
    // if (isset($_GET['id'])) {
    // 	$id = $_GET['id'];
    // 	$articles = $articlesRecord->genGetAll('categoryId', $id);
    // 	var_dump($articles, $id);

    // }

    $display = $articlesRecord->newsTemplate('../adminTemplates/articles.html.php', ['articles' => $articles]);

} else {

    $display = $articlesRecord->newsTemplate('../adminTemplates/login.html.php', []);

}