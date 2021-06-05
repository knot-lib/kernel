<?php
declare(strict_types=1);

namespace knotlib\kernel\exception;

use Throwable;

class ComponentNotInstalledException extends KernelException
{
    /**
     * construct
     *
     * @param string $component
     * @param Throwable|null $prev
     */
    public function __construct(string $component, Throwable $prev = null)
    {
        $message = 'Component not installed: ' . $component;
        parent::__construct($message, $prev);
    }
}