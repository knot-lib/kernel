<?php
declare(strict_types=1);

namespace KnotLib\Kernel\FileSystem;

interface FileSystemFactoryInterface
{
    /**
     * Returns file sytem
     *
     * @return FileSystemInterface
     */
    public static function createFileSystem() : FileSystemInterface;
}