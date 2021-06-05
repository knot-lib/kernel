<?php
declare(strict_types=1);

namespace knotlib\kernel\filesystem;

interface FileSystemInterface
{
    /**
     * Directory path exists
     *
     * @param string $dir
     *
     * @return bool
     */
    public function directoryExists(string $dir) : bool;

    /**
     * Get directory path
     *
     * @param string $dir
     *
     * @return string
     */
    public function getDirectory(string $dir) : string;

    /**
     * Directory path exists
     *
     * @param string $dir
     * @param string $filename
     *
     * @return bool
     */
    public function fileExists(string $dir, string $filename) : bool;

    /**
     * Get file path
     *
     * @param string $dir
     * @param string $filename
     *
     * @return string
     */
    public function getFile(string $dir, string $filename) : string;
}