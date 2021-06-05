<?php
declare(strict_types=1);

namespace knotlib\kernel\exceptionhandler;

use Throwable;

interface ExceptionHandlerInterface
{
    /**
     * Handle exception
     *
     * @param Throwable $e
     */
    public function handleException(Throwable $e);
}
