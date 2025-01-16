<?php

namespace IJDB\Controllers;
class Category
{
    public function __construct(
        public $myCategory
    ) {
    }

    public function list()
    {
        if (isset($_SESSION['loggedin'])) {

            $categories = $this->myCategory->genFindAll();

            return [
                'fileName' => '../adminTemplates/categories.html.php',
                'variables' => ['categories' => $categories],
                'pageTitle' => 'List of Category',
                'subTitle' => '<h2>Category</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'List of Category',
                'subTitle' => '<h2>Category</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }


    public function delete()
    {
        if (isset($_SESSION['loggedin'])) {

            $this->myCategory->genDelete('id', $_GET['id']);
            header('location: /category/list');
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Category',
                'subTitle' => '<h2>Category</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }

    public function edit()
    {
        //This page Insert and update Category
        if (isset($_SESSION['loggedin'])) {

            if (isset($_GET['id'])) {
                $category = $this->myCategory->genFind('id', $_GET['id']);
            } else {
                $category = false;
            }

            if (isset($_POST['submit'])) {


                // save($pdo, 'category', $_POST['category'], 'id');
                $this->myCategory->genSave($_POST['category']);

                header('location: /category/list');
            } else {

                return [
                    'fileName' => '../adminTemplates/editcategory.html.php',
                    'variables' => ['category' => $category],
                    'pageTitle' => 'Category',
                    'subTitle' => '<h2>Category</h2>',
                    'sidebar' => '../adminTemplates/sidebar.html.php',
                ];

            }
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Category',
                'subTitle' => '<h2>Category</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
        return [
            'fileName' => '../../public/adminTemplates/layout.html.php',
            'variables' => ['category' => $category],
            'pageTitle' => 'Category',
            'subTitle' => '<h2>Category</h2>',
            'sidebar' => '../adminTemplates/sidebar.html.php',
        ];
    }



}