<?php


// Create an instance of the DatabaseTable class
$commentRecord = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

// Load categories for the template
$categories = $categoryRecord->genFindAll();
$sidebar = $commentRecord->newsTemplate('../adminTemplates/sidebar.html.php', []);
$pageTitle = 'Northampton News - Article';
$subTitle = 'Read';

// Check if user is logged in
if (isset($_SESSION['loggedin'])) {


    // Get the article ID from the query string
    $articleId = $_GET['id'] ?? null;

    if (!$articleId) {
        // Redirect to articles page if no article ID is provided


        // Initialize variables
        $error = "";
        $comments = []; // Default to an empty array

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendcomment'])) {
            // Get user input
            $userId = $_SESSION['id'] ?? null;
            $username = $_SESSION['username'] ?? null;
            $commentText = trim($_POST['comment'] ?? "");

            if ($commentText === "") {
                $error = "Comment cannot be empty.";
            } elseif (!$userId) {
                $error = "User not identified. Please log in again.";
            } else {
                // Save the comment to the DatabaseTable
                $commentRecord->genSave([
                    'id' => null, // Let the DatabaseTable auto-generate the ID
                    'username' => $username,
                    'articleId' => $articleId,
                    'comment' => $commentText,
                    'userId' => $userId
                ]);

                // Redirect to avoid form resubmission
                header("Location: articledetail.php?id=$articleId");
            }
        }


        $comments = [];
        if ($articleId) {
            $comments = $commentRecord->genFind('articleId', $articleId) ?? [];
        }


        $display = $commentRecord->newsTemplate('../adminTemplates/articledetail.html.php', [
            'categories' => $categories,
            'comments' => $comments,
            'error' => $error
        ]);

    }
} else {
    $display = $commentRecord->newsTemplate('../adminTemplates/login.html.php', []);
}
