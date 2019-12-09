<?php
namespace KnotLib\Kernel\Module;

abstract class ComponentModule implements ModuleInterface
{
    /**
     * ComponentModule constructor.
     */
    public function __construct()
    {
    }

    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }

}