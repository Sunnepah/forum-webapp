<?php

namespace Application\Controllers;

use Application\Libraries\Database\ForumDAO;
use Application\Repositories\PostRepository;
use Application\TemplateEngine\ViewRender;
use Application\Libraries\Helper;

class AppController
{
    public function index() {
        $postRepo = new PostRepository(new ForumDAO());

        $posts = $postRepo->all();

        $isLoggedIn = isset($_SESSION['isLoggedIn']) ? true : false;
        echo ViewRender::render('index.html', ['isLoggedIn' => $isLoggedIn, 'csrf_token' => Helper::csrfToken(), "posts" => $posts]);
    }
}