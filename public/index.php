<?php
session_start();
?>

<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'categoryId');

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssidebar.html.php', []);

$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Northampton News';




$display = $myArticles->newsTemplate('../newsTemplates/newshome.html.php', []);


require '../newsTemplates/newslayout.html.php';