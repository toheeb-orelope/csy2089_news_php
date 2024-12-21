<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';

// Create an instance of the Database class
$myArticles = new Database($pdo, 'article', 'id');
$myCategory = new Database($pdo, 'category', 'id');
$myComment = new Database($pdo, 'comments', 'id');

$categories = $myCategory->genFindAll();
$comments = $myComment->genGetAll('articleId', $_GET['id']);
$sidebar = $myArticles->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

$pageTitle = 'Article';
$subTitle = 'Article';


if (isset($_GET['id'])) {

    $article = $myArticles->genFind('id', $_GET['id']);
} else {
    $article = null;
}


if (isset($_GET['id'])) {
    $comment = $myComment->genFind('id', $_GET['id']);
} else {
    $comment = false;
}

// var_dump($comments, $article);

// $postComments = $_POST['comment'];
// // $userId = $_SESSION['id'] ?? null;
// // $username = $_SESSION['username'] ?? null;
// // $commentText = trim($_POST['comment'] ?? "");
$articleId = $_GET['id'];
// $postComments['articleId'] = $articleId;
// if (isset($_POST['sendcomment'])) {
//     $myComment->genSave($postComments);

// } 
if (isset($_POST['sendcomment'])) {
    $postComments = $_POST['comment'];
    $postComments['articleId'] = $articleId;

    if (empty($postComments['id'])) {
        unset($postComments['id']); // Ensure 'id' is not sent for new comments
    }

    $myComment->genSave($postComments);
    header("Location: articledetail.php?id=$articleId");

}

$display = $myCategory->newsTemplate(
    '../newsTemplates/articledetail.html.php',
    ['article' => $article, 'comments' => $comments]
);

/*
if ($commentText === "") {
    $error = "Comment cannot be empty.";
} elseif (!$userId) {
    $error = "User not identified. Please log in again.";
} else {
    // Save the comment to the database
    $myComment->genSave([
        'id' => null, // Let the database auto-generate the ID
        'username' => $username,
        'articleId' => $articleId,
        'comment' => $commentText,
        'userId' => $userId
    ]);

    // Redirect to avoid form resubmission
    header("Location: articledetail.php?id=$articleId");
}


// $display = $myArticles->newsTemplate('../adminTemplates/articledetail.html.php', ['article' => $article]);
$display = $myCategory->newsTemplate('../newsTemplates/articledetail.html.php', ['article' => $article]);
*/
require '../newsTemplates/layout.html.php';