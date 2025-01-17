<?php


//create an instance or object of a classs
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'categoryId');

$sidebar = $articlesRecord->newsTemplate('../newsTemplates/newssidebar.html.php', []);

$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Sport News';


// $stmt = $pdo->prepare('SELECT * FROM article WHERE categoryId = 3 ORDER by date desc');
// $stmt->execute();

$articles = $articlesRecord->genFindAll();

$display = $articlesRecord->newsTemplate('../newsTemplates/sport.html.php', ['articles' => $articles]);

