<?php
$pageTitle = 'Northampton News - Home';
$subTitle = '<h2>Northampton News</h2>';

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

if (isset($_GET['id'])) {
    $articles = $myArticles->genFind('id', $_GET['id']);
} else {
    $article = null;
}


$display = $myCategory->newsTemplate('../newsTemplates/newshome.html.php', []);