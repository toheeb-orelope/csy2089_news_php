<?php
session_start();
require '../../functions/functions.php';
require '../../functions/dbconfig.php';
require '../../classes/database.php';


// Create an instance of the Database class
$myImages = new Database($pdo, 'images', 'id');
$myCategory = new Database($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();
$sidebar = $myImages->newsTemplate('../adminTemplates/sidebar.html.php', []);

$pageTitle = 'Article';
$subTitle = 'Article';

if (isset($_SESSION['loggedin'])) {

    //Reference
    /*
    https://www.geeksforgeeks.org/how-to-upload-image-into-database-and-display-it-using-php/
    16/12/2024
    */
    if (isset($_POST['upload'])) {
        $imgFile = $_FILES['imgfile']['name'];
        $tempName = $_FILES['imgfile']['tmp_name'];
        $folderName = '../images/' . $imgFile;

        $imageData = ['imgfile' => $imgFile];
        $myImages->genInsert($imageData);

        if (move_uploaded_file($tempName, $folderName)) {
            echo "<h3>&nbsp; Image uploaded successfully!</h3>";
        } else {
            echo "<h3>&nbsp; Failed to upload image!</h3>";
        }
    }




    $display = $myImages->newsTemplate('../adminTemplates/uploadimage.html.php', []);
} else {
    $display = $myImages->newsTemplate('../adminTemplates/login.html.php', []);
}

require '../../newsTemplates/layout.html.php';