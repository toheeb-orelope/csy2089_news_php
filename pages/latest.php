<?php
$pageTitle = 'Northampton News - Sport';
$subTitle = '<h2>Latest News</h2>';


// $stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
// $stmt->execute();

// $articles = $myArticles->genFindAll();
$articles = $myArticles->findByOrder();


$display = $myArticles->newsTemplate('../newsTemplates/latest.html.php', ['articles' => $articles]);