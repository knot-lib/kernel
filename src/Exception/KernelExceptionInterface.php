<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use KnotLib\Exception\KnotPhpExceptionInterface;
use KnotLib\Exception\Runtime\RuntimeExceptionInterface;

interface KernelExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{

}