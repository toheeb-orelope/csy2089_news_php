<?php
session_start();
?>
<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');

$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Edit Category';
$subTitlte = 'Add category';

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

require '../../newsTemplates/layout.html.php';