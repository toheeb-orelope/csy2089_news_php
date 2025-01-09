<?php

//create an instance or object of a classs
$myContact = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');

$categories = $myCategory->genFindAll();

$sidebar = $myContact->newsTemplate('../newsTemplates/newssibebar.html.php', ['categories' => $categories]);


$pageTitle = 'Northampton News - Contact Us';
$subTitle = '<h2>Contact Us</h2>';

if (isset($_GET['id'])) {
    $contact = $myContact->genFind('id', $_GET['id']);
} else {
    $contact = false;
}

if (isset($_POST['submit'])) {


    // save($pdo, 'category', $_POST['category'], 'id');
    $myContact->genSave($_POST['contact']);
    $display = 'Form submited';
    // header('location: view.php');
} else {

    $display = $myContact->newsTemplate(
        '../newsTemplates/contacts.html.php',
        []
    );
}
