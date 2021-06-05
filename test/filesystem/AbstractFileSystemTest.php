<?php
declare(strict_types=1);

namespace knotlib\kernel\test\filesystem;

use knotlib\kernel\exception\FileSystemException;
use knotlib\kernel\filesystem\AbstractFileSystem;
use PHPUnit\Framework\TestCase;

use Phake;
use Exception;

final class AbstractFileSystemTest extends TestCase
{
    public function testDirectoryExists()
    {
        $mock = Phake::mock(AbstractFileSystem::class);

        $ret = $mock->directoryExists('test');

        $this->assertFalse($ret);
    }
    public function testGetDirectry()
    {
        $mock = Phake::partialMock(AbstractFileSystem::class);

        try{
            $mock->getDirectory('test');
            $this->fail();
        }
        catch(FileSystemException $ex)
        {
            $this->assertTrue(true);
        }

    }
}