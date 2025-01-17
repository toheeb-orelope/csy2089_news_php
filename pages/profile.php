<?php
/*

firstreader23    @FirstReader23
secondreader23    @SecondReader23
thirdreader23    @ThirdReader23

*/

// Create an instance or object of a class
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$readersRecord = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');

$categories = $categoryRecord->genFindAll();

$pageTitle = 'Northampton News - Profile';
$subTitle = '<h2>Create Account</h2>';


$sidebar = $readersRecord->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

// Capture the redirect parameter
$redirect = $_GET['redirect'] ?? 'viewusers.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['profile']['username']) && !empty($_POST['profile']['password'])) {
        $hPassword = $_POST['profile']['password'];
        $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
        $_POST['profile']['password'] = $hashPassword;

        // Save the new user
        $readersRecord->genSave($_POST['profile']);

        // Redirect to the specified page
        header("Location: $redirect");
        exit;
    } else {
        echo 'Please fill in required fields to create an account';
    }
} else {
    $profile = null;
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $profile = $readersRecord->genFind('id', $id);
        }
    }

    $display = $categoryRecord->newsTemplate('../newsTemplates/profile.html.php', []);
}
