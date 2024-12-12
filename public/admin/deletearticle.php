<?php
session_start();
?>

<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'id');

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Northampton News - Home';
$subTitlte = 'Delete article';

if (isset($_SESSION['loggedin'])) {

	$id = $_GET['id'];
	$myArticles->genDelete('id', $id);

	$display = '<p> Article deleted <a href="articles.php"> go back to articles </a></p>';

} else {
	$display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../adminTemplates/adminlayout.html.php';
