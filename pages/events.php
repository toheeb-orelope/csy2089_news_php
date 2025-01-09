<?php


//create an instance or object of a classs
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'categoryId');

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssidebar.html.php', []);

$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Events';


// $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = 2 ORDER by date desc');
// $stmt->execute();


$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/events.html.php', ['articles' => $articles]);
