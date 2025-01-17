<?php

//create an instance or object of a classs
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $categoryRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Edit Category';
$subTitle = '<h2>Add category</ h2>';

$categories = $categoryRecord->genFindAll();

//This page Insert and update Category
if (isset($_SESSION['loggedin'])) {

    if (isset($_GET['id'])) {
        $category = $categoryRecord->genFind('id', $_GET['id']);
    } else {
        $category = false;
    }

    if (isset($_POST['submit'])) {


        // save($pdo, 'category', $_POST['category'], 'id');
        $categoryRecord->genSave($_POST['category']);

        header('location: categories.php');
    } else {

        $display = $categoryRecord->newsTemplate('../adminTemplates/editcategory.html.php', ['category' => $category]);

    }
} else {

    $display = $categoryRecord->newsTemplate('../adminTemplates/login.html.php', []);

}