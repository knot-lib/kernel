<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Test\Classes;

use KnotLib\Kernel\FileSystem\AbstractFileSystem;
use KnotLib\Kernel\FileSystem\Dir;
use KnotLib\Kernel\FileSystem\FileSystemInterface;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    /** @var vfsStreamDirectory  */
    private $root;

    /**
     * TestFileSystem constructor.
     */
    public function __construct()
    {
        $this->root = vfsStream::setup();

        mkdir(vfsStream::url('root/cache'));
    }

    /**
     * Get directory path
     *
     * @param int $dir
     *
     * @return string
     */
    public function getDirectory(int $dir) : string
    {
        switch($dir){
            case Dir::CACHE:
                return 'cache';
        }
        return '';
    }

    /**
     * Get file path
     *
     * @param int $dir
     * @param string $file
     *
     * @return string
     */
    public function getFile(int $dir, string $file) : string
    {
        return vfsStream::url('root/' . $this->getDirectory($dir) . '/' . $file);
    }
}