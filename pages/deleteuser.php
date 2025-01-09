<?php

//create an instance or object of a classs
$myUsers = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'id');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$sidebar = $myUsers->newsTemplate('../adminTemplates/sidebar.html.php', []);

$categories = $myCategory->genFindAll();

$pageTitle = 'Northampton News - Delete User';
$subTitlte = 'Delete Users';

if (isset($_SESSION['loggedin'])) {

    $id = $_GET['id'];
    $myUsers->genDelete('id', $id);

    $display = '<p> User delete <a href="viewusers.php"> go back to users </a></p>';

} else {
    $display = $myUsers->newsTemplate('../adminTemplates/login.html.php', []);

}
