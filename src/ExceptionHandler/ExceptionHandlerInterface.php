<?php
namespace KnotLib\Kernel\ExceptionHandler;

use Throwable;

interface ExceptionHandlerInterface
{
    /**
     * Handle exception
     *
     * @param Throwable $e
     *
     * @return bool
     */
    public function handleException(Throwable $e) : bool;
}
