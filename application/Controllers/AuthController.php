<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 13/11/2016
 * Time: 1:11 AM
 */

namespace Application\Controllers;

use Application\Libraries\Database\ForumDAO;
use Application\Repositories\PostRepository;
use Lustre\Request;
use \Application\Libraries\Auth\UserAuthentication;
use Application\TemplateEngine\ViewRender;

class AuthController
{
    private $request;
    private $auth;
    private $postsRepo;

    public function __construct()
    {
        $this->request = new Request();
        $this->auth = new UserAuthentication(new ForumDAO());
        $this->postsRepo = new PostRepository(new ForumDAO());
    }

    public function login() {
        $posts = $this->postsRepo->all();

        if (empty($this->request->data)) {
            echo ViewRender::render('index.html', ["message" => "Username/Password is empty!", "posts" => $posts]);
        }

        if ($user = $this->auth->login($this->request->data['username'], $this->request->data['password'])) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['user'] = $user[0];
            echo ViewRender::render('index.html', ["isLoggedIn" => true, "user" => $user[0], "posts" => $posts]);
        } else {
            echo ViewRender::render('index.html', ["isLoggedIn" => false, "message" => "Invalid username/password!", "posts" => $posts]);
        }
    }

    public function logout() {
        $posts = $this->postsRepo->all();
        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['user']);
        echo ViewRender::render('index.html', ["isLoggedIn" => false, "message" => "You are logged out!", "posts" => $posts]);
    }
}