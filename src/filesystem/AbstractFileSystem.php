<?php
declare(strict_types=1);

namespace knotlib\kernel\filesystem;

use knotlib\kernel\exception\FileSystemException;

abstract class AbstractFileSystem implements FileSystemInterface
{
    /**
     * Directory path exists
     *
     * @param string $dir
     *
     * @return bool
     */
    public function directoryExists(string $dir) : bool
    {
        return false;
    }

    /**
     * Get directory path
     *
     * @param string $dir
     *
     * @return string
     *
     * @throws FileSystemException
     */
    public function getDirectory(string $dir) : string
    {
        $msg = sprintf('Not supported directory id(%s(%d)) in %s', $dir, $dir, get_class($this));
        throw new FileSystemException($msg);
    }

    /**
     * Directory path exists
     *
     * @param string $dir
     * @param string $filename
     *
     * @return bool
     *
     * @throws FileSystemException
     */
    public function fileExists(string $dir, string $filename) : bool
    {
        return $this->directoryExists($dir) && file_exists($this->getFile($dir, $dir));
    }

    /**
     * Get file path
     *
     * @param string $dir
     * @param string $filename
     *
     * @return string
     *
     * @throws FileSystemException
     */
    public function getFile(string $dir, string $filename) : string
    {
        return $this->getDirectory($dir) . DIRECTORY_SEPARATOR . $filename;
    }
}