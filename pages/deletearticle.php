<?php

//create an instance or object of a classs
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$categories = $myCategory->genFindAll();

$pageTitle = 'Northampton News - Delete Article';
$subTitlte = 'Delete article';

if (isset($_SESSION['loggedin'])) {

    $id = $_GET['id'];
    $myArticles->genDelete('id', $id);
    // header('location: articles.php');

    $display = '<p> Article deleted <a href="articles.php"> go back to articles </a></p>';

} else {
    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}