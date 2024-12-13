<?php
session_start();
?>

<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'categoryId');

$categories = $myCategory->genFindAll();
$pageTitle = 'Northampton News - Home';

if (isset($_GET['id'])) {
    $articles = $myArticles->genFind('id', $_GET['id']);
} else {
    $article = null;
}


$pageTitle = 'Northampton News - Home';
$subTitlte = 'Northampton News';




$display = $myCategory->newsTemplate('../newsTemplates/newshome.html.php', []);


require '../newsTemplates/layout.html.php';