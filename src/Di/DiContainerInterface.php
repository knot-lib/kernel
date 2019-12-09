<?php
namespace KnotLib\Kernel\Di;

use ArrayAccess;
use Exception;

use Psr\Container\ContainerInterface as PsrContainerInterface;
use KnotLib\Kernel\Exception\DiContainerException;

interface DiContainerInterface extends PsrContainerInterface, ArrayAccess
{
    /**
     * Extend copmonent
     *
     * $extend_callback :
     *     function( $component, $container ){
     *         $component->doSomething();          // do something to exntend the component
     *         return $component;
     *     }
     *
     * @param string $id
     * @param callable $extend_callback        must return extended component
     *
     * @return mixed
     *
     * @throws DiContainerException
     */
    public function extend(string $id, callable $extend_callback);
}