<?php
namespace KnotLib\Kernel\FileSystem;

interface FileSystemInterface
{
    /**
     * Directory path exists
     *
     * @param int $dir
     *
     * @return bool
     */
    public function directoryExists(int $dir) : bool;

    /**
     * Get directory path
     *
     * @param int $dir
     *
     * @return string
     */
    public function getDirectory(int $dir) : string;

    /**
     * Directory path exists
     *
     * @param int $dir
     * @param string $filename
     *
     * @return bool
     */
    public function fileExists(int $dir, string $filename) : bool;

    /**
     * Get file path
     *
     * @param int $dir
     * @param string $filename
     *
     * @return string
     */
    public function getFile(int $dir, string $filename) : string;
}