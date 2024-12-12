<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'categoryId');


$pageTitle = 'Northampton News - Sport';
$subTitlte = 'Advertise with us';



$articles = $myArticles->genFindAll();

$display = $myArticles->newsTemplate('../newsTemplates/advertise.html.php', []);


require '../newsTemplates/newslayout.html.php';