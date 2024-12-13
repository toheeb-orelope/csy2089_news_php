<?php
session_start();

require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');


$pageTitle = 'Northampton News - Categories';
$subTitlte = 'categories';

$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);

if (isset($_SESSION['loggedin'])) {


	$categories = $myCategory->genFindAll();
	$display = $myCategory->newsTemplate('../adminTemplates/categories.html.php', ['categories' => $categories]);

} else {

	$display = $myCategory->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';
