<?php
namespace KnotLib\Kernel\Module;

abstract class ComponentModule implements ModuleInterface
{
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