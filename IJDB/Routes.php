<?php

namespace IJDB;

class Routes
{
    public $categoryRecord;
    public function __construct()
    {
        require '../functions/dbconfig.php';
        $this->categoryRecord = new \GenericClasses\DatabaseTable($pdo, 'category', 'id');
    }
    public function getPage($pageName)
    {
        require '../functions/dbconfig.php';
        $articlesRecord = new \GenericClasses\DatabaseTable($pdo, 'article', 'id');
        $commentRecord = new \GenericClasses\DatabaseTable($pdo, 'comments', 'id');
        $readersRecord = new \GenericClasses\DatabaseTable($pdo, 'reader', 'id');
        $accountRecord = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'id');
        $contactRecord = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'id');
        $myStatus = new \GenericClasses\DatabaseTable($pdo, 'accounts', 'status');
        $statusRecord = new \GenericClasses\DatabaseTable($pdo, 'contactus', 'status');

        $controllers = [];
        $controllers['article'] = new \IJDB\Controllers\Article(
            $articlesRecord,
            $this->categoryRecord,
            $commentRecord,
            $readersRecord
        );

        $controllers['category'] = new \IJDB\Controllers\Category($this->categoryRecord);
        $controllers['admin'] = new \IJDB\Controllers\Admin(
            $articlesRecord,
            $this->categoryRecord,
            $commentRecord,
            $readersRecord,
            $accountRecord,
            $contactRecord
        );

        $controllers['news'] = new \IJDB\Controllers\News(
            $articlesRecord,
            $this->categoryRecord,
            $commentRecord,
            $readersRecord,
            $accountRecord,
            $contactRecord
        );

        $controllers['account'] = new \IJDB\Controllers\Account(
            $accountRecord,
            $this->categoryRecord,
            $myStatus
        );

        $controllers['contacts'] = new \IJDB\Controllers\Contacts(
            $contactRecord,
            $this->categoryRecord,
            $statusRecord
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
            'sidebar' => $page['sidebar'] ?? null,
            'subTitle' => $page['subTitle'] ?? ''
        ];
    }

    public function getLayout()
    {
        $categories = $this->categoryRecord->genFindAll();
        return [
            'categories' => $categories
        ];
    }
}
