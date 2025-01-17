<?php

//create an instance or object of a classs
$contactRecord = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$categories = $categoryRecord->genFindAll();

$sidebar = $contactRecord->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);


$pageTitle = 'Northampton News - Contact Us';
$subTitle = '<h2>Contact Us</h2>';

if (isset($_GET['id'])) {
    $contact = $contactRecord->genFind('id', $_GET['id']);
} else {
    $contact = false;
}

if (isset($_POST['submit'])) {


    // save($pdo, 'category', $_POST['category'], 'id');
    $contactRecord->genSave($_POST['contact']);
    $display = 'Form submited';
    // header('location: view.php');
} else {

    $display = $contactRecord->newsTemplate(
        '../newsTemplates/contacts.html.php',
        []
    );
}
