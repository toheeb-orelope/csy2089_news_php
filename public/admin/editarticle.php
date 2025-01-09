<?php
session_start();
require '../../functions/functions.php';
require '../../functions/dbconfig.php';
require '../../GenericClasses/database.php';

$pageTitle = 'Northampton News - Article';

// Create instances of the database class
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');
$myImage = new Database($pdo, 'images', 'id');

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);
$subTitle = '<h2>Add Article</h2>';

if (isset($_SESSION['loggedin'])) {
    $categories = $myCategory->genFindAll();

    if (isset($_GET['id'])) {
        $articles = $myArticles->genFind('id', $_GET['id']);
    } else {
        $articles = 'No record to insert';
    }



    if (isset($_POST['submit'])) {

        $username = $_SESSION['username'];

        $imgFile = $_FILES['imgFile']['name'];
        $tempName = $_FILES['imgFile']['tmp_name'];
        //Need to change the file name to a unique name
        $folderName = '../images/' . $imgFile;
        $imageData = ['imgFile' => $imgFile];
        $postArt = $_POST['article'];
        $postArt['imgFile'] = $imgFile;
        $postArt['username'] = $username;
        $myArticles->genSave($postArt);
        move_uploaded_file($tempName, $folderName);
        header('location: articles.php');

        // header('location: articles.php');
    } else {
        $display = $myArticles->newsTemplate(
            '../adminTemplates/editarticle.html.php',
            ['article' => $articles, 'categories' => $categories]
        );
    }
} else {
    $display = $myArticles->newsTemplate(
        '../adminTemplates/login.html.php',
        []
    );
}

require '../../newsTemplates/layout.html.php';