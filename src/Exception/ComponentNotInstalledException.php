<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use Throwable;

class ComponentNotInstalledException extends KernelException
{
    /**
     * construct
     *
     * @param string $component
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $component, int $code = 0, Throwable $prev = null)
    {
        $message = 'Component not installed: ' . $component;
        parent::__construct($message, $code, $prev);
    }
}