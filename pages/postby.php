<?php
$pageTitle = 'Published Articles';
// $subTitle = '<h2>Articles published by ' . $_GET['username'] . '</h2>';
$subTitle = '<h2>Articles published by <span style="font-weight: bold; color: blue;">' . htmlspecialchars($_GET['username']) . '</span></h2>';




// $articles = $myArticles->genFindAll();
$articles = [];
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $articles = $myArticles->genGetAll('username', $username);
    // var_dump($articles, $username);

}

// $display = $myArticles->newsTemplate('../adminTemplates/postby.html.php', ['articles' => $articles]);
$display = $myCategory->newsTemplate('../newsTemplates/postby.html.php', ['articles' => $articles]);
