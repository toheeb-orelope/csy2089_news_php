<?php
$pageTitle = 'Home';
$subTitle = '<h2>Northampton News</h2>';

$sidebar = $articlesRecord->newsTemplate(
    '../newsTemplates/newssibebar.html.php',
    ['categories' => $categories]
);



$display = $categoryRecord->newsTemplate('../newsTemplates/newshome.html.php', []);