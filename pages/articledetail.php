<?php

$pageTitle = 'Article';
$subTitle = '<h2>Article Details</h2>';
$action = $_GET['action'] ?? null;

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = $myArticles->genFind('id', $articleId);
    $comments = $myComment->genGetAll('articleId', $articleId);
} else {
    $article = null;
    $comments = [];
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $myComment->genDelete('id', $_GET['id']);
}

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $comment = $myComment->genFind('id', $_GET['id']);
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

        $myComment->genSave($postComments);
        // header("Location: articledetail.php?id=$articleId");
        // exit;
    } else {
        header("Location: ../newsTemplates/login.html.php?redirect=articledetail.php?id=$articleId");
        exit;
    }
}


$display = $myCategory->newsTemplate('../newsTemplates/articledetail.html.php', ['article' => $article, 'comments' => $comments]);