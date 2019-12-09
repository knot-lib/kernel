<?php
namespace KnotLib\Kernel\Exception;

use Throwable;

class SessionBucketException extends KernelException
{
    /**
     * construct
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct($message, int $code = 0, Throwable $prev = null){
        parent::__construct($message, $code, $prev);
    }
}