<?php

//create an instance or object of a classs
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $categoryRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Northampton News - Delete Category';
$subTitlte = 'Delete category';

if (isset($_SESSION['loggedin'])) {

    $id = $_GET['id'];
    $categoryRecord->genDelete('id', $id);
    // header('location: categories.php');

    $display = '<p> Category deleted <a href="categories.php"> go back to categories </a></p>';

} else {
    $display = $categoryRecord->newsTemplate('../adminTemplates/login.html.php', []);

}