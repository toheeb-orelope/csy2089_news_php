<?php
session_start();
?>
<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myContact = new Database($pdo, 'contactus', 'status');


$pageTitle = 'View Contacts';
$subTitlte = 'Message board';
if (isset($_SESSION['loggedin'])) {


    // $contacts = $myContact->genFindAll();
    $contacts = $myContact->genFind('status', 'pending');
    var_dump($contacts);
    $display = newsTemlate('../adminTemplates/viewcontact.html.php', ['contacts' => $contacts]);

} else {

    $display = $myContact->newsTemplate('../adminTemplates/viewcontact.html.php', []);

}

require '../adminTemplates/adminlayout.html.php';