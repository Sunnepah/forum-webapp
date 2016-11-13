<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 13/11/2016
 * Time: 2:42 PM
 */

namespace Application\Repositories;


use Application\Libraries\Database\ForumDAO;
use Application\Models\Post;

class PostRepository implements Repository
{

    protected $model;
    private $forumDAO;

    /**
     * Repository constructor.
     * @param ForumDAO $forumDAO
     */
    public function __construct(ForumDAO $forumDAO)
    {
        $this->model = new Post();
        $this->forumDAO = $forumDAO;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function all($columns = array('*')) {
        return $this->model->findAll($this->forumDAO);
    }

    /**
     * @param \stdClass $data
     * @return string
     */
    public function create($data) {
        return $this->model->save($this->forumDAO, $data);
    }
}