<?php
session_start();
?>
<?php
require '../../founctions/functions.php';
require '../../founctions/dbconfig.php';
require '../../classes/database.php';

//create an instance or object of a classs
$myContact = new Database($pdo, 'contactus', 'id');
$myCategory = new Database($pdo, 'category', 'id');
$sidebar = $myCategory->newsTemplate('../adminTemplates/sidebar.html.php', []);
$categories = $myCategory->genFindAll();

$pageTitle = 'View Contacts';
$subTitlte = 'Message board';
if (isset($_SESSION['loggedin'])) {


    if (isset($_POST['update_status'])) {
        $avaUser = $_SESSION['loggedin']['username'];

        foreach ($_POST['status'] as $id => $newStatus) {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id && in_array($newStatus, ['pending', 'done'])) {
                $myContact->genUpdate([
                    'id' => $id,
                    'status' => $newStatus,
                    // 'update_by_user' => $avaUser,
                ]);
            }
        }
    }

    //Search by keyword
    if (isset($_GET['keyword'])) {
        $contacts = $myContact->fetchByKeyword('status', $_GET['keyword']);
    } else {
        $contactsPending = $myContact->genGetAll('status', 'pending');
        $contactsDone = $myContact->genGetAll('status', 'done');
        $contacts = array_merge($contactsDone, $contactsPending);
        var_dump($contactsDone, $contactsPending, $contacts);
    }

    // $contacts = $myContact->genFindAll();

    $display = newsTemlate('../adminTemplates/viewcontact.html.php', ['contacts' => $contacts]);

} else {

    $display = $myContact->newsTemplate('../adminTemplates/viewcontact.html.php', []);

}

require '../../newsTemplates/layout.html.php';
