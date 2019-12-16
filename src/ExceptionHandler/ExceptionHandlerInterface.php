<?php
namespace KnotLib\Kernel\ExceptionHandler;

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
