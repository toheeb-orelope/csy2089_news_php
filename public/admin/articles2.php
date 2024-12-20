<?php
session_start();
?>
<?php
require '../../functions/functions.php';
require '../../functions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');


$categories = $myCategory->genFindAll();

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Home';
$subTitlte = 'Articles';
if (isset($_SESSION['loggedin'])) {


    $articles = $myArticles->genFindAll();


    $display = $myArticles->newsTemplate('../adminTemplates/articles.html.php', ['articles' => $articles]);

} else {

    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';