<?php


$pageTitle = 'Northampton News - Article';

// Create instances of the DatabaseTable class
$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myImage = new \GenericClasses\DatabaseTable($pdo, 'images', 'id');

$sidebar = $articlesRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);
$subTitle = '<h2>Add Article</h2>';

if (isset($_SESSION['loggedin'])) {
    $categories = $categoryRecord->genFindAll();

    if (isset($_GET['id'])) {
        $articles = $articlesRecord->genFind('id', $_GET['id']);
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
        $articlesRecord->genSave($postArt);
        move_uploaded_file($tempName, $folderName);
        header('location: articles.php');

        // header('location: articles.php');
    } else {
        $display = $articlesRecord->newsTemplate(
            '../adminTemplates/editarticle.html.php',
            ['article' => $articles, 'categories' => $categories]
        );
    }
} else {
    $display = $articlesRecord->newsTemplate(
        '../adminTemplates/login.html.php',
        []
    );
}
