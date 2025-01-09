<?php
//create an instance or object of a classs
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');


$pageTitle = 'Northampton News - Categories';
$subTitle = '<h2>Categories</h2>';

$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);

if (isset($_SESSION['loggedin'])) {


    $categories = $myCategory->genFindAll();
    $display = $myCategory->newsTemplate('../adminTemplates/categories.html.php', ['categories' => $categories]);

} else {

    $display = $myCategory->newsTemplate('../adminTemplates/login.html.php', []);

}