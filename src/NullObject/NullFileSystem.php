<?php
declare(strict_types=1);

namespace KnotLib\Kernel\NullObject;

use KnotLib\Kernel\FileSystem\AbstractFileSystem;
use KnotLib\Kernel\FileSystem\FileSystemInterface;

final class NullFileSystem extends AbstractFileSystem implements FileSystemInterface
{
}