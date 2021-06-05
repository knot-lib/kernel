<?php
declare(strict_types=1);

namespace knotlib\kernel\exception;

use Throwable;

class ApplicationExecutionException extends KernelException
{
    /**
     * construct
     *
     * @param string $message
     * @param Throwable|null $prev
     */
    public function __construct(string $message, Throwable $prev = null){
        parent::__construct($message, $prev);
    }
}