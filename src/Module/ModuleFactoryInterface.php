<?php
namespace KnotLib\Kernel\Module;

use KnotLib\Kernel\Kernel\ApplicationInterface;

interface ModuleFactoryInterface
{
    /**
     * Create module
     *
     * @param string $module_class
     * @param ApplicationInterface $app
     *
     * @return ModuleInterface|null       return null if the factory can not create module instance
     */
    public function createModule(string $module_class, ApplicationInterface $app);
}