<?php
//create an instance or object of a classs
$myContact = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
$myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
$myStatus = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'status');


$sidebar = $myCategory->newsTemplate(
    '../adminTemplates/sidebar.html.php',
    []
);
$categories = $myCategory->genFindAll();

$pageTitle = 'View Contacts';
$subTitle = '<h2>Message board</h2>';
if (isset($_SESSION['loggedin'])) {

    $status = $myStatus->getEnumValues();

    //Search by keyword
    if (isset($_GET['keyword'])) {
        $contacts = $myContact->fetchByKeyword('status', $_GET['keyword']);
    } else {
        $contacts = $myContact->genFindAll();
    }

    // echo '<pre>';
    // print_r($contacts);
    // echo '</pre>';

    $display = newsTemplates(
        '../adminTemplates/viewcontact.html.php',
        ['contacts' => $contacts, 'status' => $status]
    );

} else {
    $display = $myContact->newsTemplate(
        '../adminTemplates/login.html.php',
        []
    );
}