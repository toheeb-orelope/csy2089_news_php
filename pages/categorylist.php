<?php
//create an instance or object of a classs
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');


$pageTitle = 'Northampton News - Categories';
$subTitle = '<h2>Categories</h2>';

$sidebar = $categoryRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);

if (isset($_SESSION['loggedin'])) {


    $categories = $categoryRecord->genFindAll();
    $display = $categoryRecord->newsTemplate('../adminTemplates/categories.html.php', ['categories' => $categories]);

} else {

    $display = $categoryRecord->newsTemplate('../adminTemplates/login.html.php', []);

}