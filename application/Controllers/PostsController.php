<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 13/11/2016
 * Time: 2:40 PM
 */

namespace Application\Controllers;

use Application\Libraries\Database\ForumDAO;
use Application\Repositories\PostRepository;
use Application\TemplateEngine\ViewRender;
use Lustre\Request;
use Application\Libraries\ImageUploader;

class PostsController
{
    protected $postRepo;
    private $request;

    /**
     * PostsController constructor.
     */
    public function __construct() {
        $this->postRepo = new PostRepository(new ForumDAO());
        $this->request = new Request();
    }

    /**
     * Retrieve all posts.
     *
     * @return \Lustre\Response
     */
    public function getAll() {
        $posts = $this->postRepo->all();

        echo ViewRender::render('index.html', ["posts" => $posts]);
    }

    /**
     * Create a new post
     */
    public function post() {
        $posts = $this->postRepo->all();

        if (!isset($_SESSION['isLoggedIn'])) {
            echo ViewRender::render('index.html', ["message" => "You are not logged in!", "posts" => $posts]);
            return;
        }

        $isLoggedIn = true;

        if (empty($this->request->data) || empty($_FILES['userfile'])) {
            echo ViewRender::render('index.html', ["message" => "Post data is empty", "isLoggedIn" => $isLoggedIn, "posts" => $posts]);
            return;
        }


        /** The data must be well validated before it gets here */
        /** stored image in s3 */
        $image_url = ImageUploader::upload_image($_FILES);
        if (!$image_url) {
            echo ViewRender::render('index.html', ["message" => "Unable to create a post!", "isLoggedIn" => $isLoggedIn, "posts" => $posts]);
            return;
        }

        $post = new \stdClass();
        $post->image_url = $image_url;
        $post->title = $this->request->data['image_title'];
        $post->user_id = $_SESSION['user']['user_id'];

        /** Assumed only one thread of discussion */
        $post->thread_id = 1;

        try {
            $response = $this->postRepo->create($post);

            if($response == true) {
                $posts = $this->postRepo->all();
                echo ViewRender::render('index.html', ["message" => "Post created successfully", "isLoggedIn" => $isLoggedIn, "posts" => $posts]);
                return;
            } else {
                echo ViewRender::render('index.html', ["message" => "Unable to create a post!", "isLoggedIn" => $isLoggedIn, "posts" => $posts]);
                return;
            }
        } catch (\Exception $e) {
            echo ViewRender::render('index.html', ["message" => "Unable to create a post!", "isLoggedIn" => $isLoggedIn, "posts" => $posts]);
        }
    }
}