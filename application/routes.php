<?php

/*
|-------------------------------------------------------------------
| Registering all Application routes
|-------------------------------------------------------------------
*/

$app->router()->get('/',  'AppController:index');

/** Auth Routes */
$app->router()->post('/login', 'AuthController:login');
$app->router()->post('/logout', 'AuthController:logout');

/** Post Routes */
$app->router()->get('/posts', 'PostsController:getAll');
$app->router()->post('/posts', 'PostsController:post');