<?php

namespace app\Controllers;

use app\BaseController;
use app\Models\PostModel;
use app\utils\SessionTool;

class HomeController extends BaseController
{
    /**
     * Display the home page.
     */

    public function index(): void
    {
        $mostRecentPosts = PostModel::getMostRecentPosts(3);
        $this->render("HomeView", [
            'posts' => $mostRecentPosts,
            'isAdmin' => SessionTool::userIsAdmin(),
            'currentPage' => 'home'
        ]);
    }

}
