<?php
//create an instance or object of a classs
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categories = $categoryRecord->genFindAll();


$pageTitle = 'Northampton News - Sport';
$subTitle = '<h2>Latest News</h2>';


// $stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
// $stmt->execute();

// $articles = $articlesRecord->genFindAll();
$articles = $articlesRecord->findByOrder();


$display = $articlesRecord->newsTemplate('../newsTemplates/latest.html.php', ['articles' => $articles]);

