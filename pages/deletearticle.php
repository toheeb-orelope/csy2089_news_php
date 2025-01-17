<?php

//create an instance or object of a classs
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $articlesRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);

$categories = $categoryRecord->genFindAll();

$pageTitle = 'Northampton News - Delete Article';
$subTitlte = 'Delete article';

if (isset($_SESSION['loggedin'])) {

    $id = $_GET['id'];
    $articlesRecord->genDelete('id', $id);
    // header('location: articles.php');

    $display = '<p> Article deleted <a href="articles.php"> go back to articles </a></p>';

} else {
    $display = $articlesRecord->newsTemplate('../adminTemplates/login.html.php', []);

}