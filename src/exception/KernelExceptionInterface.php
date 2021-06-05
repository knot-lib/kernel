<?php
declare(strict_types=1);

namespace knotlib\kernel\exception;

use knotlib\exception\KnotPhpExceptionInterface;
use knotlib\exception\Runtime\RuntimeExceptionInterface;

interface KernelExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{

}