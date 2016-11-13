<?php

namespace Application\Repositories;

interface Repository
{
    /**
     * Return a collection of models
     *
     * @param  array $columns
     * @return model collections
     */
    public function all($columns = array('*'));

    /**
     * Create a new model object
     *
     * @param  \stdClass $data
     * @return mixed
     */
    public function create($data);
}