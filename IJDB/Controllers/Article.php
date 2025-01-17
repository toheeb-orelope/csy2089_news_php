<?php
namespace IJDB\Controllers;
class Article
{

    public function __construct(
        public $articlesRecord,
        public $categoryRecord,
        public $commentRecord,
        public $readersRecord,
    ) {
    }

    public function list()
    {
        if (isset($_SESSION['loggedin'])) {

            $articles = $this->articlesRecord->genFindAll();

            return [
                'fileName' => '../adminTemplates/articles.html.php',
                'variables' => ['articles' => $articles],
                'pageTitle' => 'List of Article',
                'subTitle' => '<h2>Article</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'List of Article',
                'subTitle' => '<h2>Article</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }


    public function edit()
    {

        if (isset($_SESSION['loggedin'])) {
            $categories = $this->categoryRecord->genFindAll();

            if (isset($_GET['id'])) {
                $article = $this->articlesRecord->genFind('id', $_GET['id']);
            } else {
                $article = 'No record to insert';
            }



            if (isset($_POST['submit'])) {

                $username = $_SESSION['username'];

                $imgFile = $_FILES['imgFile']['name'];
                $tempName = $_FILES['imgFile']['tmp_name'];
                // Generate a unique file name
                //https://stackoverflow.com/questions/8810656/change-file-name-to-uniqid-in-php
                $uniqueFileName = uniqid() . '_' . time() . '.' . pathinfo($imgFile, PATHINFO_EXTENSION);
                $folderName = 'images/' . $uniqueFileName;
                $imageData = ['imgFile' => $uniqueFileName];
                $postArt = $_POST['article'];
                $postArt['imgFile'] = $uniqueFileName;
                $postArt['username'] = $username;
                $this->articlesRecord->genSave($postArt);
                move_uploaded_file($tempName, $folderName);
                header('location: /article/list');

                // header('location: articles.php');
            } else {

                return [
                    'fileName' => '../adminTemplates/editarticle.html.php',
                    'variables' => ['categories' => $categories, 'article' => $article],
                    'pageTitle' => 'Edit Article',
                    'subTitle' => '<h2>Article</h2>',
                    'sidebar' => '../adminTemplates/sidebar.html.php',
                ];
            }
        } else {

            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'Edit Article',
                'subTitle' => '<h2>Article</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
        return [
            'fileName' => '../adminTemplates/layout.html.php',
            'variables' => ['article' => $article, 'categories' => $categories],
            'pageTitle' => 'Edit Article',
            'subTitle' => '<h2>Article</h2>',
            'sidebar' => '../adminTemplates/sidebar.html.php',
        ];
    }

    public function delete()
    {
        if (isset($_SESSION['loggedin'])) {

            $this->articlesRecord->genDelete('id', $_GET['id']);

            header('location: /article/list');

            return [
                'fileName' => '../adminTemplates/layout.html.php',
                'variables' => [],
                'pageTitle' => 'delete Article',
                'subTitle' => '<h2>Article</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        } else {
            return [
                'fileName' => '../adminTemplates/login.html.php',
                'variables' => [],
                'pageTitle' => 'delete Article',
                'subTitle' => '<h2>Article</h2>',
                'sidebar' => '../adminTemplates/sidebar.html.php',
            ];
        }
    }
}