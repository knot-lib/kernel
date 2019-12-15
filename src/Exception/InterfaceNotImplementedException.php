<?php
declare(strict_types=1);

namespace KnotLib\Kernel\Exception;

use Throwable;

class InterfaceNotImplementedException extends KernelException
{
    /**
     * InterfaceNotImplementedException constructor.
     *
     * @param string $class
     * @param string $interface_name
     * @param int $code
     * @param Throwable|NULL $prev
     */
    public function __construct( string $class, string $interface_name, int $code = 0, Throwable $prev = NULL )
    {
        parent::__construct( "Class($class) must implement interface: $interface_name", $code, $prev );
    }
}