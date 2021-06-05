<?php
declare(strict_types=1);

namespace knotlib\kernel\module;

use knotlib\kernel\kernel\ApplicationInterface;

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