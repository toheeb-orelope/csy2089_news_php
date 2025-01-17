<?php
//create an instance or object of a classs
$contactRecord = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
$categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myStatus = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'status');


$sidebar = $categoryRecord->newsTemplate(
    '../adminTemplates/sidebar.html.php',
    []
);
$categories = $categoryRecord->genFindAll();

$pageTitle = 'View Contacts';
$subTitle = '<h2>Message board</h2>';
if (isset($_SESSION['loggedin'])) {

    $status = $myStatus->getEnumValues();

    //Search by keyword
    if (isset($_GET['keyword'])) {
        $contacts = $contactRecord->fetchByKeyword('status', $_GET['keyword']);
    } else {
        $contacts = $contactRecord->genFindAll();
    }

    // echo '<pre>';
    // print_r($contacts);
    // echo '</pre>';

    $display = newsTemplates(
        '../adminTemplates/viewcontact.html.php',
        ['contacts' => $contacts, 'status' => $status]
    );

} else {
    $display = $contactRecord->newsTemplate(
        '../adminTemplates/login.html.php',
        []
    );
}