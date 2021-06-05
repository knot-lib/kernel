<?php
declare(strict_types=1);

namespace knotlib\kernel\nullobject;

use knotlib\kernel\filesystem\AbstractFileSystem;
use knotlib\kernel\filesystem\FileSystemInterface;

final class NullFileSystem extends AbstractFileSystem implements FileSystemInterface
{
}