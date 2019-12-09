<?php
namespace KnotLib\Kernel\Module;

abstract class AbstractModule implements ModuleInterface
{
    /**
     * AbstractModule constructor.
     */
    public function __construct()
    {
    }

    /**
     * Declare dependent on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }

    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponents() : array
    {
        return [];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return Components::MODULE;
    }

}