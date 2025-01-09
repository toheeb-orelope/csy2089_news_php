<?php

//create an instance or object of a classs
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Edit Category';
$subTitle = '<h2>Add category</ h2>';

$categories = $myCategory->genFindAll();

//This page Insert and update Category
if (isset($_SESSION['loggedin'])) {

    if (isset($_GET['id'])) {
        $category = $myCategory->genFind('id', $_GET['id']);
    } else {
        $category = false;
    }

    if (isset($_POST['submit'])) {


        // save($pdo, 'category', $_POST['category'], 'id');
        $myCategory->genSave($_POST['category']);

        header('location: categories.php');
    } else {

        $display = $myCategory->newsTemplate('../adminTemplates/editcategory.html.php', ['category' => $category]);

    }
} else {

    $display = $myCategory->newsTemplate('../adminTemplates/login.html.php', []);

}