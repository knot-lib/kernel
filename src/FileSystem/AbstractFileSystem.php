<?php
namespace KnotLib\Kernel\FileSystem;

use KnotLib\Kernel\Exception\FileSystemException;

abstract class AbstractFileSystem implements FileSystemInterface
{
    /**
     * Directory path exists
     *
     * @param int $dir
     *
     * @return bool
     */
    public function directoryExists(int $dir) : bool
    {
        return false;
    }

    /**
     * Get directory path
     *
     * @param int $dir
     *
     * @return string
     *
     * @throws FileSystemException
     */
    public function getDirectory(int $dir) : string
    {
        $msg = sprintf('Not supported directory id(%s(%d)) in %s', Dir::toString($dir), $dir, get_class($this));
        throw new FileSystemException($msg);
    }

    /**
     * Directory path exists
     *
     * @param int $dir
     * @param string $filename
     *
     * @return bool
     *
     * @throws FileSystemException
     */
    public function fileExists(int $dir, string $filename) : bool
    {
        return $this->directoryExists($dir) && file_exists($this->getFile($dir, $dir));
    }

    /**
     * Get file path
     *
     * @param int $dir
     * @param string $file
     *
     * @return string
     *
     * @throws FileSystemException
     */
    public function getFile(int $dir, string $file) : string
    {
        return $this->getDirectory($dir) . '/' . $file;
    }
}