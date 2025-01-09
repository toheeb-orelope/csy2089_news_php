<?php

namespace IJDB;

class Routes
{
    public $myCategory;
    public function __construct()
    {
        require '../functions/dbconfig.php';
        $this->myCategory = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
    }
    public function getPage($pageName)
    {
        require '../functions/dbconfig.php';
        $myArticles = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
        $myComment = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');
        $myReader = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');
        $myAccount = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'id');
        $myContact = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
        $myStatus = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'status');
        $contactStatus = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'status');

        $controllers = [];
        $controllers['article'] = new \IJDB\Controllers\Article(
            $myArticles,
            $this->myCategory,
            $myComment,
            $myReader
        );

        $controllers['category'] = new \IJDB\Controllers\Cagetory($this->myCategory);
        $controllers['admin'] = new \IJDB\Controllers\Admin(
            $myArticles,
            $this->myCategory,
            $myComment,
            $myReader,
            $myAccount,
            $myContact
        );

        $controllers['news'] = new \IJDB\Controllers\News(
            $myArticles,
            $this->myCategory,
            $myComment,
            $myReader,
            $myAccount,
            $myContact
        );

        $controllers['account'] = new \IJDB\Controllers\Account(
            $myAccount,
            $this->myCategory,
            $myStatus
        );

        $controllers['contacts'] = new \IJDB\Controllers\Contacts(
            $myContact,
            $this->myCategory,
            $contactStatus
        );

        $route = $pageName;

        if ($route == '') {
            $page = $controllers['news']->home();
        } else {
            list($controllerName, $functionName) = explode('/', $route);
            $controller = $controllers[$controllerName];
            $page = $controller->$functionName();
        }
        return [
            'title' => $page['pageTitle'],
            'tempName' => $page['fileName'],
            'variables' => $page['variables'],
            'sidebar' => $page['sidebar'] ?? null
        ];
    }

    public function getLoyout()
    {
        $categories = $this->myCategory->genFindAll();
        return [
            'categories' => $categories
        ];
    }
}
