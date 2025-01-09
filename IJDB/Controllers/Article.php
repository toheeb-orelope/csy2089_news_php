<?php

class Article
{

    public function __construct(
        public $myArticles,
        public $myCategory,
        public $myImage
    ) {
    }

    public function list()
    {
        $articles = $this->myArticles->genFindAll();

        return [
            'fileName' => '../../public/adminTemplates/article.html.php',
            'variables' => ['articles' => $articles],
            'pageTitle' => 'Article',
            'subTitle' => '<h2>Article</h2>',
        ];
    }


    public function edit()
    {
        if (isset($_SESSION['loggedin'])) {
            $categories = $this->myCategory->genFindAll();
            $images = $this->myImage->genFindAll();

            if (isset($_GET['id'])) {
                $articles = $this->myArticles->genFind('id', $_GET['id']);
            } else {
                $articles = 'No record to update';
            }

            if (isset($_POST['submit'])) {

                $username = $_SESSION['username'];
                // Insert the uploaded image and retrieve the image ID
                $imageId = $this->myImage->letInsertImage(
                    $_FILES['imgfile'],
                    $this->myImage
                );

                if ($imageId) {
                    // Save the article with the image ID and username
                    $postArt = $_POST['article'];
                    $postArt['imageId'] = $imageId;
                    $postArt['username'] = $username;
                    $this->myArticles->genSave($postArt);
                    header('location: /article/list');
                }

                // header('location: articles.php');
            } else {
                $this->myArticles->newsTemplate(
                    '../../public/adminTemplates/editarticle.html.php',
                    ['article' => $articles, 'categories' => $categories]
                );
            }
        } else {
            $this->myArticles->newsTemplate(
                '../../public/adminTemplates/login.html.php',
                []
            );
        }
        return [
            'fileName' => '../../public/adminTemplates/layout.html.php',
            'variables' => ['article' => $articles, 'categories' => $categories],
            'pageTitle' => 'Article',
            'subTitle' => '<h2>Article</h2>',
        ];
    }

    public function delete()
    {
        $this->myArticles->genDelete('id', $_POST['id']);
        header('location: /article/list');
    }
}