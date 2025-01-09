<?php


$categories = $myCategory->genFindAll();

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Home';
$subTitle = '<h2>Articles</h2>';
if (isset($_SESSION['loggedin'])) {


    $articles = $myArticles->genFindAll();
    // $articles = [];
    // if (isset($_GET['id'])) {
    // 	$id = $_GET['id'];
    // 	$articles = $myArticles->genGetAll('categoryId', $id);
    // 	var_dump($articles, $id);

    // }

    $display = $myArticles->newsTemplate('../adminTemplates/articles.html.php', ['articles' => $articles]);

} else {

    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}