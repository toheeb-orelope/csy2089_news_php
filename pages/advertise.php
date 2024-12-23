<?php

$pageTitle = 'Northampton News - Advert';
$subTitle = '<h2>Advertise with us</h2>';
$sidebar = $myCategory->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);



$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/advertise.html.php', []);
