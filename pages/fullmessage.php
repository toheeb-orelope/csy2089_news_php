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

    if (isset($_POST['update_status'])) {

        $avaUser = $_SESSION['username'];

        foreach ($_POST['status'] as $id => $newStatus) {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id && in_array(strtolower($newStatus), ['pending', 'done'])) {
                $updateResult = $myContact->genUpdate([
                    'id' => $id,
                    'status' => $newStatus,
                    'update_by_user' => $avaUser,
                ]);
                header('location: viewcontacts.php');

            }
        }

    }

    if (isset($_GET['id'])) {
        $contact = $myContact->genFind('id', $_GET['id']);
        if (!$contact) {
            $contact = [];
        }
    } else {
        $contact = [];
    }

    $status = $myStatus->getEnumValues();

    $display = newsTemplates(
        '../adminTemplates/fullmessage.html.php',
        ['contact' => $contact, 'status' => $status]
    );

} else {
    $display = $myContact->newsTemplate(
        '../adminTemplates/login.html.php',
        []
    );
}