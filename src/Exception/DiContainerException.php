<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use Throwable;

class DiContainerException extends KernelException
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