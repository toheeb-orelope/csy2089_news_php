<?php
session_start();
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

$pageTitle = 'Northampton News - Article';

// Create instances of the database class
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');
$myImage = new Database($pdo, 'images', 'id');

$sidebar = $myArticles->newsTemplate('../adminTemplates/sidebar.html.php', []);
$subTitle = 'Add Article';

if (isset($_SESSION['loggedin'])) {
    $categories = $myCategory->genFindAll();
    $images = $myImage->genFindAll();

    if (isset($_GET['id'])) {
        $articles = $myArticles->genFind('id', $_GET['id']);
    } else {
        $articles = 'No record to insert';
    }



    if (isset($_POST['submit'])) {

        $username = $_SESSION['username'];
        // Insert the uploaded image and retrieve the image ID
        $imageId = $myImage->letInsertImage(
            $_FILES['imgfile'],
            $myImage
        );

        if ($imageId) {
            // Save the article with the image ID and username
            $postArt = $_POST['article'];
            $postArt['imageId'] = $imageId;
            $postArt['username'] = $username; // Add active user to the article data
            $myArticles->genSave($postArt);
            $myImage->redirectWithMessage('Image uploaded successfully!!!', 'success', 'articles.php');
        } else {
            $myImage->redirectWithMessage('Image upload failed.', 'bad', 'editarticle.php');
            die('Image upload failed.');
        }

        // header('location: articles.php');
    } else {
        $display = $myArticles->newsTemplate(
            '../adminTemplates/editarticle.html.php',
            ['article' => $articles, 'categories' => $categories]
        );
    }
} else {
    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);
}

require '../../newsTemplates/layout.html.php';