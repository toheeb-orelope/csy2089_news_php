<?php
session_start();
?>

<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'categoryId');

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssidebar.html.php', []);

$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Events';


// $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = 2 ORDER by date desc');
// $stmt->execute();


$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/events.html.php', ['articles' => $articles]);


require '../newsTemplates/newslayout.html.php';