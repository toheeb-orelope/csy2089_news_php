<?php


//create an instance or object of a classs
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'categoryId');

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssidebar.html.php', []);

$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Sport News';


// $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = 3 ORDER by date desc');
// $stmt->execute();

$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/sport.html.php', ['articles' => $articles]);

