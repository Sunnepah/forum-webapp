<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 12/11/2016
 * Time: 11:31 PM
 */

namespace Application\TemplateEngine;

use Twig_Loader_Filesystem;
use Twig_Environment;

class ViewRender
{
    public static function render($viewName, $data) {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../assets/views/');
        $twig = new Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../../assets/views/cache',
        ));
        $twig = new Twig_Environment($loader, array());

        return $twig->render($viewName, $data);
    }
}