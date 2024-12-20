<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");
?>

<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');
$myArticles = new Database($pdo, 'article', 'id');
$categories = $myCategory->genFindAll();


$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Latest News';


// $stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
// $stmt->execute();

// $articles = $myArticles->genFindAll();
$articles = $myArticles->findByOrder();


$display = $myArticles->newsTemplate('../newsTemplates/latest.html.php', ['articles' => $articles]);


require '../newsTemplates/layout.html.php';
