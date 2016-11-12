<?php

class fileStructureTest extends TestCase
{
    
    public function testApplicationDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../application'));
    }

    public function testControllersDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../application/Controllers/'));
    }

    public function testModelsDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../application/Models/'));
    }

    public function testConfigDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../application/Config/'));
    }

    public function testLibrariesDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../application/Libraries/'));
    }
    
    public function testPublicRootDirectoryExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../web/'));
    }

    public function testPublicAppEntryFileExist()
    {
        $this->assertTrue(file_exists(__DIR__ . '/../web/index.php'));
    }
}