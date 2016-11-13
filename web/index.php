<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 12/11/2016
 * Time: 6:21 PM
 */

require '../vendor/autoload.php';

session_start();

$app = \Lustre\Application::singleton();

/*
|-------------------------------------------------------------------
| Register Application Routes
|-------------------------------------------------------------------
*/
require __DIR__ . '/../application/routes.php';

/*
|-------------------------------------------------------------------
| Running the Application
|-------------------------------------------------------------------
*/
$app->run();