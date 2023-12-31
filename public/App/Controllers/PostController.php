<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\PostModel;
use App\utils\SessionTool;

class PostController extends BaseController
{
    /**
     * Display a list of the most recent posts.
     */
    public function index(): void
    {
        $mostRecentPosts = PostModel::getMostRecentPosts(2);

        $this->render("PostsNewView", [
            'posts' => $mostRecentPosts,
            'currentPage' => 'posts',

        ]);
    }

    /**
     * Display a single post by its ID.
     */
    public function show(): void
    {
        $postId = $_GET['id'];

        $post = PostModel::getPostById($postId);
        if (!$post) {
            header('Location: /error');
            exit();
        }

        $this->render("PostView", [
            'post' => $post,
            'currentPage' => '',
        ]);
    }

    /**
     * Create a new post if the user is an admin.
     */
    public function create(): void
    {
        if (SessionTool::userIsAdmin()) {
            $errorMessage = "";
            $successMessage = "";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $title = htmlspecialchars($_POST['title'] ?? '');
                $content = htmlspecialchars($_POST['content'] ?? '');

                if (empty($title)) {
                    $errorMessage = "Veuillez renseigner le titre.";
                } elseif (empty($content)) {
                    $errorMessage = "Veuillez renseigner du contenu.";
                } else {
                    $postData = [
                        'title' => $title,
                        'content' => $content,
                    ];

                    $postModel = new PostModel();

                    if ($postModel->createPost($postData)) {
                        $successMessage = "L'article a été créé avec succès.";
                    } else {
                        $errorMessage = "Une erreur est survenue lors de la création de l'article.";
                    }
                }
            }

            $this->render("PostsCreationView", [
                'currentPage' => 'post/create',
                'errorMessage' => $errorMessage,
                'successMessage' => $successMessage,
            ]);
        }
    }

    /**
     * Edit an existing post if the user is an admin.
     */
    public function edit(): void
    {
        if (SessionTool::userIsAdmin()) {
            $errorMessage = "";
            $successMessage = "";

            $postId = $_GET['id'];

            if (!ctype_digit($postId)) {
                header('Location: /error');
                exit();
            }

            $post = PostModel::getPostById($postId);

            if (!$post) {
                header('Location: /error');
                exit();
            }

            if (isset($_POST['title']) && isset($_POST['content'])) {

                $title = htmlspecialchars($_POST['title']);
                $content = htmlspecialchars($_POST['content']);

                if (empty($title) || empty($content)) {
                    $errorMessage = "Le titre et le contenu doivent être renseignés.";
                } else {
                    $postData = [
                        'title' => $title,
                        'content' => $content,
                    ];

                    $postUpdated = PostModel::updatePost($postId, $postData);

                    if ($postUpdated) {
                        $successMessage = "L'article a été mis à jour avec succès.";
                        header('Location: /');
                    } else {
                        $errorMessage = "Une erreur est survenue lors de la mise à jour de l'article.";
                    }
                }
            } else {
                $errorMessage = "Veuillez renseigner tous les champs du formulaire.";
            }

            $this->render("PostsEditView", [
                'post' => $post,
                'currentPage' => 'post/edit',
                'errorMessage' => $errorMessage,
                'successMessage' => $successMessage,
            ]);
        }
    }

    /**
     * Delete a post if the user is an admin.
     */
    public function delete(): void
    {
        if (SessionTool::userIsAdmin()) {
            $postId = $_GET['id'];

            $result = PostModel::deletePost($postId);
            if ($result) {
                header('Location: /');
            } else {
                header('Location: /error');
            }
        }
    }
}
