<?php
session_start();
?>
<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'id');

// $sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Home';
$subTitlte = 'Articles';
if (isset($_SESSION['loggedin'])) {


	$articles = $myArticles->genFindAll();
	$display = newsTemlate('../adminTemplates/articles.html.php', ['articles' => $articles]);

} else {

	$display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../adminTemplates/adminlayout.html.php';