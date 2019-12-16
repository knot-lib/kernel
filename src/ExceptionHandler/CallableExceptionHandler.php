<?php
declare(strict_types=1);

namespace KnotLib\Kernel\ExceptionHandler;

use Throwable;

final class CallableExceptionHandler implements ExceptionHandlerInterface
{
    /** @var callable  */
    private $callable;

    /**
     * CallableExceptionHandler constructor.
     *
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * {@inheritDoc}
     */
    public function handleException(Throwable $e)
    {
        ($this->callable)($e);
    }
}