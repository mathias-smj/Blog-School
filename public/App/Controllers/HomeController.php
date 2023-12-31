<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\PostModel;
use App\utils\SessionTool;

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
