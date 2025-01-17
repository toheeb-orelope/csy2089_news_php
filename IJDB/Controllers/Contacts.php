<?php
namespace IJDB\Controllers;
class Contacts
{
    public function __construct(
        public $contactRecord,
        public $categoryRecord,
        public $statusRecord

    ) {
    }

    public function list()
    {

        $categories = $this->categoryRecord->genFindAll();

        $pageTitle = 'View Contacts';
        $subTitle = '<h2>Message board</h2>';
        if (isset($_SESSION['loggedin'])) {

            $status = $this->statusRecord->getEnumValues();

            //Search by keyword
            if (isset($_GET['keyword'])) {
                $contacts = $this->contactRecord->fetchByKeyword('status', $_GET['keyword']);
            } else {
                $contacts = $this->contactRecord->genFindAll();
            }

            // echo '<pre>';
            // print_r($contacts);
            // echo '</pre>';
            return [
                'fileName' => '../adminTemplates/viewcontact.html.php',
                'variables' => ['contacts' => $contacts, 'status' => $status],
                'pageTitle' => 'Contacts List',
                'subTitle' => '<h2>Message board</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Contact Us',
                'subTitle' => '<h2>List of Contacts</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }

    }

    public function edit()
    {
        $categories = $this->categoryRecord->genFindAll();

        $pageTitle = 'View Contacts';
        $subTitle = '<h2>Message board</h2>';

        if (isset($_SESSION['loggedin'])) {

            if (isset($_POST['update_status'])) {

                $avaUser = $_SESSION['username'];

                foreach ($_POST['status'] as $id => $newStatus) {
                    $id = filter_var($id, FILTER_VALIDATE_INT);
                    if ($id && in_array(strtolower($newStatus), ['pending', 'done'])) {
                        $updateResult = $this->contactRecord->genUpdate([
                            'id' => $id,
                            'status' => $newStatus,
                            'update_by_user' => $avaUser,
                        ]);
                        header('location: /contacts/list');

                    }
                }

            }

            if (isset($_GET['id'])) {
                $contact = $this->contactRecord->genFind('id', $_GET['id']);
                if (!$contact) {
                    $contact = [];
                }
            } else {
                $contact = [];
            }

            $status = $this->statusRecord->getEnumValues();

            return [
                'fileName' => '../adminTemplates/fullmessage.html.php',
                'variables' => ['contact' => $contact, 'status' => $status],
                'pageTitle' => 'Edit Contact',
                'subTitle' => '<h2>Edit Contact</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];

        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Edit Contact',
                'subTitle' => '<h2>Edit Contact</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }
}