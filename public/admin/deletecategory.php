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

$pageTitle = 'Northampton News - Delete Category';
$subTitlte = 'Delete category';

if (isset($_SESSION['loggedin'])) {

	$id = $_GET['id'];
	$myCategory->genDelete('id', $id);
	// header('location: categories.php');

	$display = '<p> Category deleted <a href="categories.php"> go back to categories </a></p>';

} else {
	$display = $myCategory->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';