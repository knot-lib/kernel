<?php
namespace KnotLib\Kernel\Module;

interface ModuleFactoryInterface
{
    /**
     * Create module
     *
     * @param string $module_class
     *
     * @return ModuleInterface|null
     */
    public function createModule(string $module_class);
}