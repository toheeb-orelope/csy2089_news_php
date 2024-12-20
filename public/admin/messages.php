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

$pageTitle = 'Message';
$subTitlte = 'Message';
if (isset($_SESSION['loggedin'])) {


    $message = $_SESSION['message'] ?? 'An unknown error occurred.';
    $messageType = $_SESSION['messageType'] ?? 'error';
    $redirectUrl = $_SESSION['redirect_url'] ?? null;


    unset($_SESSION['message'], $_SESSION['redirect_url'], $_SESSION['messageType']);

    $display = $myArticles->newsTemplate(
        '../adminTemplates/messages.html.php',
        [
            'message' => $message,
            'messageType' => $messageType,
            'redirectUrl' => $redirectUrl
        ]
    );

} else {

    $display = $myArticles->newsTemplate('../adminTemplates/login.html.php', []);

}

require '../../newsTemplates/layout.html.php';