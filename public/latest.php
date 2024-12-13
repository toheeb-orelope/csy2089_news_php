<?php
session_start();
?>

<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'categoryId');


$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Latest News';


// $stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
// $stmt->execute();

// $articles = $myArticles->genFindAll();
$articles = $myArticles->findByOrder(null, null, 'DESC');

$display = $myArticles->newsTemplate('../newsTemplates/sport.html.php', ['articles' => $articles]);


require '../newsTemplates/layout.html.php';
