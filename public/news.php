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
$subTitlte = 'News';


// $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = 1 ORDER by date desc');
// $stmt->execute();

$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/news.html.php', ['articles' => $articles]);

require '../newsTemplates/newslayout.html.php';
