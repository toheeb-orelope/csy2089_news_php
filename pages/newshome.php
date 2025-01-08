<?php
$pageTitle = 'Northampton News - Home';
$subTitle = '<h2>Northampton News</h2>';

$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);



$display = $myCategory->newsTemplate('../newsTemplates/newshome.html.php', []);