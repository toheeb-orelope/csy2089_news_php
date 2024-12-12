<?php
session_start();
?>
<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

$pageTitle = 'Northampton News - Article';
//create an instance or object of a classs
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);

$subTitlte = 'Add Article';
if (isset($_SESSION['loggedin'])) {



    $categories = $myCategory->genFindAll();


    if (isset($_GET['id'])) {
        $articles = $myArticles->genFind('id', $_GET['id']);
    } else {
        $articles = false;
    }

    var_dump($categories, $articles);

    if (isset($_POST['submit'])) {

        // save($pdo, 'category', $_POST['category'], 'id');
        $myArticles->genSave($_POST['article']);
        header('location: articles.php');
    } else {

        $display = $myArticles->newsTemplate('../adminTemplates/editarticle.html.php', ['article' => $articles, 'categories' => $categories]);

    }

} else {
    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}




require '../adminTemplates/adminlayout.html.php';

