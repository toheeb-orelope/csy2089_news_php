<?php
require '../functions/dbconfig.php';
require '../functions/functions.php';
require '../classes/database.php';


/*

firstreader23    @FirstReader23
secondreader23    @SecondReader23
thirdreader23    @ThirdReader23

*/

// Create an instance or object of a class
$myCategory = new Database($pdo, 'category', 'id');
$myReader = new Database($pdo, 'reader', 'id');

$categories = $myCategory->genFindAll();
$pageTitle = 'Northampton News - Profile';
$subTitle = '<h2>Create Account</h2>';


$sidebar = $myReader->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);

// Capture the redirect parameter
$redirect = $_GET['redirect'] ?? 'viewusers.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['profile']['username']) && !empty($_POST['profile']['password'])) {
        $hPassword = $_POST['profile']['password'];
        $hashPassword = password_hash($hPassword, PASSWORD_DEFAULT);
        $_POST['profile']['password'] = $hashPassword;

        // Save the new user
        $myReader->genSave($_POST['profile']);

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
            $profile = $myReader->genFind('id', $id);
        }
    }

    $display = $myCategory->newsTemplate('../newsTemplates/profile.html.php', []);
}

require '../newsTemplates/layout.html.php';
