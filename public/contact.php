<?php
require '../founctions/dbconfig.php';
require '../founctions/functions.php';
require '../classes/database.php';


//create an instance or object of a classs
$myContact = new Database($pdo, 'contactus', 'id');


$pageTitle = 'Northampton News - Contact Us';
$subTitlte = 'Contact Us';

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

    $display = $myContact->newsTemplate('../newsTemplates/contacts.html.php', []);
}





require '../newsTemplates/newslayout.html.php';