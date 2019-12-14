<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use Throwable;

class ModuleInstallationException extends KernelException
{
    /**
     * construct
     *
     * @param string $module_class
     * @param string $reason
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $module_class, string $reason = null, int $code = 0, Throwable $prev = null)
    {
        $message = "Failed to install module: {$module_class} reason: {$reason}";
        parent::__construct($message, $code, $prev);
    }
}