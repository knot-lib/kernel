<?php
declare(strict_types=1);

namespace knotlib\kernel\exception;

use Throwable;

class InterfaceNotImplementedException extends KernelException
{
    /**
     * InterfaceNotImplementedException constructor.
     *
     * @param string $class
     * @param string $interface_name
     * @param Throwable|NULL $prev
     */
    public function __construct( string $class, string $interface_name, Throwable $prev = NULL )
    {
        parent::__construct( "Class($class) must implement interface: $interface_name", $prev );
    }
}