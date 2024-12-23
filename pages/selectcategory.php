<?php
$pageTitle = 'Article';
$subTitle = '<h2>Article</h2>';


$categories = $myCategory->genFindAll();
$articles = $myArticles->genGetAll('categoryId', $_GET['id']);






$display = $myCategory->newsTemplate(
    '../newsTemplates/selectcategory.htm.php',
    ['articles' => $articles]
);
