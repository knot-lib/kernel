<?php
declare(strict_types=1);

namespace knotlib\kernel\exception;

use Throwable;

class ModuleInstallationException extends KernelException
{
    /**
     * construct
     *
     * @param string $module_class
     * @param string $reason
     * @param Throwable|null $prev
     */
    public function __construct(string $module_class, string $reason = '', Throwable $prev = null)
    {
        $message = "Failed to install module: {$module_class} reason: {$reason}";
        parent::__construct($message, $prev);
    }
}