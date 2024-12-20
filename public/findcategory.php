<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myCategory = new Database($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();

$categories = ['categories' => $categories];


require '../newsTemplates/newslayout.html.php';