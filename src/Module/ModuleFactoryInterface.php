<?php
namespace KnotLib\Kernel\Module;

interface ModuleFactoryInterface
{
    /**
     * Create module
     *
     * @param string $module_class
     *
     * @return ModuleInterface|null       return null if the factory can not create module instance
     */
    public function createModule(string $module_class);
}