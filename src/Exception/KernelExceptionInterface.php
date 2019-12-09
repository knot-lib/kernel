<?php
namespace KnotLib\Kernel\Exception;

use KnotLib\Exception\KnotPhpExceptionInterface;
use KnotLib\Exception\Runtime\RuntimeExceptionInterface;

interface KernelExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{

}