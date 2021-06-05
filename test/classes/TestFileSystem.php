<?php /** @noinspection PhpPropertyOnlyWrittenInspection */
declare(strict_types=1);

namespace knotlib\kernel\test\classes;

use knotlib\kernel\filesystem\AbstractFileSystem;
use knotlib\kernel\filesystem\Dir;
use knotlib\kernel\filesystem\FileSystemInterface;
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
     * @param string $dir
     *
     * @return string
     */
    public function getDirectory(string $dir) : string
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
     * @param string $dir
     * @param string $filename
     *
     * @return string
     */
    public function getFile(string $dir, string $filename) : string
    {
        return vfsStream::url('root/' . $this->getDirectory($dir) . '/' . $filename);
    }
}