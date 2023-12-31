<?php

namespace App;

use App\utils\SessionTool;

class BaseController
{
    /**
     * Render a view with optional data and wrap it in the base view.
     *
     * @param string $view The name of the view file to render.
     * @param array $data  Optional data to pass to the view.
     * @return void
     */
    protected function render($view, $data = []) {
        extract($data);
        ob_start();
        $isAdmin = SessionTool::userIsAdmin();
        include_once "Views/$view.php";
        $content = ob_get_clean();

        include_once "Views/baseView.php";
    }
}
