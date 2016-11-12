<?php

class TestCase extends PHPUnit_Framework_TestCase
{
    
    public function createApplication()
    {
        return require_once (__DIR__ . "/../vendor/autoload.php");
    }
    
    public function test_default() {
    
    }
}
