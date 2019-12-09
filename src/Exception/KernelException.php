<?php
namespace KnotLib\Kernel\Exception;

use Throwable;
use KnotLib\Exception\KnotPhpException;

class KernelException extends KnotPhpException implements KernelExceptionInterface
{
    /**
     * construct
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $message, int $code = 0, Throwable $prev = null){
        parent::__construct($message, $code, $prev);
    }
}