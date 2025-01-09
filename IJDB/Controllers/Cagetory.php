<?php

class Cagetory
{
    public function __construct(
        public $myCategory
    ) {
    }

    public function list()
    {
        $categories = $this->myCategory->genFindAll();

        return [
            'fileName' => '../../public/adminTemplates/category.html.php',
            'variables' => ['categories' => $categories],
            'pageTitle' => 'Category',
            'subTitle' => '<h2>Category</h2>',
        ];
    }


    public function delete()
    {
        $this->myCategory->genDelete('id', $_POST['id']);
        header('location: /categories');
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

                $this->myCategory->newsTemplate('../../public/adminTemplates/editcategory.html.php', ['category' => $category]);

            }
        } else {

            $this->myCategory->newsTemplate('../../public/adminTemplates/login.html.php', []);

        }
        return [
            'fileName' => '../../public/adminTemplates/layout.html.php',
            'variables' => ['category' => $category],
            'pageTitle' => 'Category',
            'subTitle' => '<h2>Category</h2>',
        ];
    }



}