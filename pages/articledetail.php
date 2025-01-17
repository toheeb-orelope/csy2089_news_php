<?php

$articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$commentRecord = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');
$readersRecord = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');

$categories = $categoryRecord->genFindAll();

$pageTitle = 'Article';
$subTitle = '<h2>Article Details</h2>';
$action = $_GET['action'] ?? null;

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = $articlesRecord->genFind('id', $articleId);
    $comments = $commentRecord->genGetAll('articleId', $articleId);
} else {
    $article = null;
    $comments = [];
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $commentRecord->genDelete('id', $_GET['id']);
}

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $comment = $commentRecord->genFind('id', $_GET['id']);
} else {
    $comment = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendcomment'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $username = $_SESSION['username'];
        $postComments = $_POST['comment'];
        $postComments['articleId'] = $articleId;
        $postComments['username'] = $username;

        if (empty($postComments['id'])) {
            unset($postComments['id']);
        }

        $commentRecord->genSave($postComments);
        header("Location: articledetail.php?id=$articleId");
        // exit;
    } else {
        header("Location: ../newsTemplates/login.html.php?redirect=articledetail.php?id=$articleId");
        exit;
    }
}


$display = $categoryRecord->newsTemplate('../newsTemplates/articledetail.html.php', ['article' => $article, 'comments' => $comments]);
