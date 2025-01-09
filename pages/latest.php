<?php
//create an instance or object of a classs
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categories = $myCategory->genFindAll();


$pageTitle = 'Northampton News - Sport';
$subTitle = '<h2>Latest News</h2>';


// $stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
// $stmt->execute();

// $articles = $myArticles->genFindAll();
$articles = $myArticles->findByOrder();


$display = $myArticles->newsTemplate('../newsTemplates/latest.html.php', ['articles' => $articles]);

